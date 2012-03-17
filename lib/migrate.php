<?php
/**
 * ownCloud
 *
 * @author Tom Needham
 * @copyright 2012 Tom Needham tom@owncloud.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


/**
 * provides an interface to all search providers
 */
class OC_Migrate{
	
	// Holds the db object
	static private $MDB2=false;
	// Array of OC_Migration_Provider objects
	static private $providers=array();
	// Schema db object
	static private $schema=false;
	// User id of the user to import/export
	static private $uid=false;
	// Path to the sqlite db
	static private $dbpath=false;
	// Holds the ZipArchive object
	static private $zip=false;
	// String path to export
	static private $zippath=false;
	// Stores the type of export
	static private $exporttype=false;
	// Array of temp files to be deleted after zip creation
	static private $tmpfiles=array();
	
	/**
	 * register a new migration provider
	 * @param OC_Migrate_Provider $provider
	 */
	public static function registerProvider($provider){
		self::$providers[]=$provider;
	}
	
	/**
	 * @breif creates a migration.db in the users data dir with their app data in
	 * @return bool whether operation was successfull
	 */
	private static function exportAppData( ){
				
		self::connectDB();
		$ok = true;
		$return = array();
		
		// Find the providers
		$apps = OC_App::getAllApps();
		
		foreach($apps as $app){
			$path = OC::$SERVERROOT . '/apps/' . $app . '/lib/migrate.php';
			if( file_exists( $path ) ){
				include( $path );	
			}	
		}
		
		// Foreach provider
		foreach( self::$providers as $provider ){
			$failed = false;
			
			// Does this app use the database?
			if(file_exists(OC::$SERVERROOT.'/apps/'.$provider->id.'/appinfo/database.xml')){
				// Create some app tables
				$tables = self::createAppTables( $provider->id );
				if( is_array( $tables ) ){
					// Save the table names
					foreach($tables as $table){
						$return['apps'][$provider->id]['tables'][] = $table;	
					}	
				} else {
					// It failed to create the tables
					$failed = true;
				}	
			}
			
			// Run the import function?
			if( !$failed ){
				$return['apps'][$provider->id]['success'] = $provider->export( self::$uid );	
			} else {
				$return['apps'][$provider->id]['success'] = false;	
				$return['apps'][$provider->id]['message'] = 'failed to create the app tables';	
			}
			
			// Now add some app info the the return array
			$appinfo = OC_App::getAppInfo( $provider->id );
			$return['apps'][$provider->id]['version'] = $appinfo['version'];
			
		}
		
		return $return;
		
	}
	
	/**
	* @breif creates an export file for the whole system
	* @param optional $exporttype string export type ('instance','system' or 'userfiles')
	* @param optional $path string path to zip destination (with trailing slash)
	* @return path to the zip or false if there was a problem
	*/
	static public function createSysExportFile( $exporttype='instance', $path=null ){
		// Calculate zip name
		$zipname = "owncloud_export_" . date("y-m-d_H-i-s") . ".zip";
		// Get the data dir
		$datadir = OC_Config::getValue( 'datadirectory' );
		// Calculate destination
		if( !is_null( $path ) ){
			// Path given 
			// Is a directory?
			if( !is_dir( $path ) ){
				OC_Log::write('migration', 'Path supplied to createSysExportFile() is not a directory', OC_Log::ERROR);
				return false;
			}	
			// Is writeable
			if( !is_writeable( $path ) ){
				OC_Log::write('migration', 'Path supplied to createSysExportFile() is not writeable', OC_Log::ERROR);	
				return false;
			}
			self::$zippath = $path . $zipname;
		} else {
			// Save in tmp dir
			self::$zippath = sys_get_temp_dir() . '/' . $zipname;
		}	
		// Create the zip object
		self::$zip = new ZipArchive;
		// Try to create the zip
	    if( !self::createZip() ){
	    	return false;
	    }
		// Handle export types
		$exporttypes = array( 'userfiles', 'instance', 'system' );
		self::$exporttype = in_array( $exporttype, $exporttypes ) ? $exporttype : false;
		if( !self::$exporttype ){
			OC_Log::write( 'migration', 'Export type: '.$exporttype.' is not supported.', OC_Log::ERROR);
			return false;	
		}
		switch( self::$exporttype ){
			case 'instance':
				// Creates a zip that is compatable with the import function
				$dbfile = tempnam( "/tmp", "owncloud_export_data_" );
				OC_DB::getDbStructure( $dbfile, 'MDB2_SCHEMA_DUMP_ALL');
				
				// Now add in *dbname* and *dbprefix*
				$dbexport = file_get_contents( $dbfile );
				$dbnamestring = "<database>\n\n <name>" . OC_Config::getValue( "dbname", "owncloud" );
				$dbtableprefixstring = "<table>\n\n  <name>" . OC_Config::getValue( "dbtableprefix", "oc_" );
				$dbexport = str_replace( $dbnamestring, "<database>\n\n <name>*dbname*", $dbexport );
				$dbexport = str_replace( $dbtableprefixstring, "<table>\n\n  <name>*dbprefix*", $dbexport );
				// Write the new db export file
				file_put_contents( $dbfile, $dbexport );
				self::$zip->addFile( $dbfile, "dbexport.xml" );
				// Add user data
				foreach(OC_User::getUsers() as $user){
					self::addDirToZip( $datadir . '/' . $user . '/', true, "/userdata/" );	
				}
			break;
			case 'userfiles':
				// Creates a zip with all of the users files
				foreach(OC_User::getUsers() as $user){
					self::addDirToZip( $datadir . '/' . $user . '/', true, "/" );	
				}
			break;
			case 'system':
				// Creates a zip with the owncloud system files
				self::addDirToZip( OC::$SERVERROOT . '/', false, '/');
				foreach (array(".git", "3rdparty", "apps", "core", "files", "l10n", "lib", "ocs", "search", "settings", "tests") as $dir) {
			    	self::addDirToZip( OC::$SERVERROOT . '/' . $dir, true, "/");
				}
			break;	
		}
		// Add export info
		self::addExportInfo();
		// Close the zip
		if( !self::closeZip() ){
			return false;	
		}
		return self::$zippath;
		
	}
	
	/**
	* @breif adds a json file with infomation on the export to the zips root (used on import)
	* @return bool
	*/
	static private function addExportInfo( $array=array() ){
		$info = array(
						'ocversion' => OC_Util::getVersion(),
						'exporttime' => time(),
						'exportedby' => OC_User::getUser(),
						'exporttype' => self::$exporttype
					);
		// Add hash if user export
		if( self::$exporttype = 'user' ){
			$query = OC_DB::prepare( "SELECT password FROM *PREFIX*users WHERE uid LIKE ?" );
			$result = $query->execute( array( self::$uid ) );
			$row = $result->fetchRow();
			$hash = $row ? $row['password'] : false;
			if( !$hash ){
				OC_Log::write( 'migration', 'Failed to get the users password hash', OC_log::ERROR);
				return false;
			}
			$info['hash'] = $hash;  	
		}
		// Merge in other data
		$info = array_merge( $info, $array );
		// Create json
		$json = json_encode( $info );
		$tmpfile = tempnam("/tmp", "oc_export_info_");
		self::$tmpfiles[] = $tmpfile;
		if( !file_put_contents( $tmpfile, $json ) ){
			return false;
		} else {
			self::$zip->addFile( $tmpfile, "export_info.json" );
			return true;
		}
	}
	
	
	/**
	* @breif tried to finalise the zip
	* @return bool
	*/
	static private function closeZip(){
		if( !self::$zip->close() ){
			OC_Log::write('migration', 'Failed to save the zip with error: '.self::$zip->getStatusString(), OC_Log::ERROR);
			self::cleanup();
			return false;
		} else {
			OC_Log::write('migration', 'Export zip created ok', OC_Log::INFO);
			self::cleanup();
			return true;	
		}	
	}
	
	/**
	* @breif cleans up after the zip
	*/
	static private function cleanup(){
		// Delete tmp files
		foreach(self::$tmpfiles as $i){
			unlink( $i );	
		}	
	}
	
	/**
	* @breif creates a zip user export
	* @param optional $uid string user id of the user to export (defaults to current)
	* @param optional $path string path to folder to create file in (with trailing slash) (defaults to current user's data dir)
	* @return false on failure | string path on success
	*/
	static public function createUserExportFile( $uid=null, $path=null ){
		// User passed?
		$uid = is_null( $uid ) ? OC_User::getUser() : $uid ;
		// Is a database user?
		if( !OC_User_Database::userExists( $uid ) ){
			OC_Log::write('migration', 'User: '.$uid.' is not in the database and so cannot be exported.', OC_Log::ERROR);
			return false;	
		}
		// Set the uid
		self::$uid = $uid;
		// Create the zip object
		self::$zip = new ZipArchive;
		// Calculate users data dir
		$user = OC_User::getUser();
		$userdatadir = OC_Config::getValue( 'datadirectory' ) . '/' . $user . '/';
		// Calculate zip name
		$zipname = "owncloud_userexport_" . $user . '_' . date("y-m-d_H-i-s") . ".zip";
		// Calculate destination
		if( !is_null( $path ) ){
			// Path given 
			// Is a directory?
			if( !is_dir( $path ) ){
				OC_Log::write('migration', 'Path supplied to createUserExportFile() is not a directory', OC_Log::ERROR);
				return false;
			}	
			// Is writeable
			if( !is_writeable( $path ) ){
				OC_Log::write('migration', 'Path supplied to createUserExportFile() is not writeable', OC_Log::ERROR);	
				return false;
			}
			self::$zippath = $path . $zipname;
		} else {
			// Save in users data dir
			self::$zippath = $userdatadir . $zipname;
		}
		// Try to create the zip
	    if( !self::createZip() ){
	    	return false;
	    }
	    // Export the app info
		$exportinfo = json_encode( self::addExportInfo( self::exportAppData() ) );
		file_put_contents( $userdatadir . '/exportinfo.json', $exportinfo );
		// Add the data dir to the zip
		self::addDirToZip( $userdatadir );
	    // Close the zip
		if( !self::closeZip() ){
			return false;	
		}
		// All good
	    return self::$zippath;
	} 
	
	/**
	* @breif tries to create the zip
	* @return bool
	*/
	static private function createZip(){
		// Check if properties are set
		if( !self::$zip || !self::$zippath ){
			OC_Log::write('migration', 'createZip() called but $zip and/or $zippath have not been set', OC_Log::ERROR);
			return false;	
		}
		if ( self::$zip->open( self::$zippath, ZIPARCHIVE::CREATE ) !== TRUE ) {
			OC_Log::write('migration', 'Failed to create the zip with error: '.self::$zip->getStatusString(), OC_Log::ERROR);
			return false;
	    } else {
	    	return true;	
	    }	
	}
		
	/**
	* @breif adds a directory to the zip object
	* @param $dir string path of the directory to add
	* @param $recursive bool 
	* @param $internaldir string path of folder to add dir to in zip
	* @return bool
	*/
	static private function addDirToZip($dir, $recursive=true, $internaldir='') {
	    $dirname = basename($dir);
	    self::$zip->addEmptyDir($internaldir . $dirname);
	    $internaldir.=$dirname.='/';
	
	    if ($dirhandle = opendir($dir)) {
			while (false !== ( $file = readdir($dirhandle))) {
	
				if (( $file != '.' ) && ( $file != '..' )) {
		
					if (is_dir($dir . '/' . $file) && $recursive) {
						self::addDirToZip($dir . '/' . $file, $recursive, $internaldir);
					} elseif (is_file($dir . '/' . $file)) {
						self::$zip->addFile($dir . '/' . $file, $internaldir . $file);
					}
				}
			}
			closedir($dirhandle);
	    } else {
			OC_Log::write('admin_export',"Was not able to open directory: " . $dir,OC_Log::ERROR);
			return false;
	    }
	    return true;
	}
	
	/**
	* @breif returns an array of apps that support migration
	* @return array
	*/
	static public function getApps(){
		$allapps = OC_App::getAllApps();
		foreach($allapps as $app){
			$path = OC::$SERVERROOT . '/apps/' . $app . '/lib/migrate.php';
			if( file_exists( $path ) ){
				$supportsmigration[] = $app;
			}	
		}
		return $supportsmigration;	
	}
	
	/**
	* @breif imports a new user
	* @param $db string path to migration.db
	* @param $info array of migration ino
	* @param $uid optional uid to use
	* @return bool if the import succedded
	*/
	public static function importAppData( $db, $info, $uid=false ){
				
		if(!self::$uid){
			OC_Log::write('migration','Tried to import without passing a uid',OC_Log::FATAL);
			return false;
		}
		
		// Check if the db exists
		if( file_exists( $db ) ){
			// Connect to the db
			if(!self::connectDB( $db )){
				return false;
			}	
		} else {
			OC_Log::write('migration','Migration.db not found at: '.$db, OC_Log::FATAL );	
			return false;
		}
		
		if( !is_array( $info ) ){
			OC_Log::write('migration','$migrateinfo is not an array', OC_Log::FATAL);
			return false;
		}
		
		// Set the user id
		self::$uid = $info->migrateinfo->uid;
				
		$apps = $info->app;
		
		foreach( self::$providers as $provider){
			// Is the app in the export?
			if( array_key_exists( $provider->id, $apps ) ){
				// Did it succeed?
				if( $app[$provider->id] ){
					// Then do the import
					$provider->import( $info );	
				}	
			}	
		}
		
		return true;
	
	}
	
	// @breif connects to migration.db, or creates if not found
	// @param $db optional path to migration.db, defaults to user data dir
	// @return bool whether the operation was successful
	private static function connectDB( $dbpath=null ){
		OC_Log::write('migration','connecting to migration.db for user: '.self::$uid,OC_Log::INFO);
		// Fail if no user is set
		if(!self::$uid){
			OC_Log::write('migration','connectDB() called without self::$uid being set',OC_Log::INFO);
			return false;
		}
		// Already connected
		if(!self::$MDB2){
			require_once('MDB2.php');
			
			$datadir = OC_Config::getValue( "datadirectory", OC::$SERVERROOT."/data" );
			
			self::$dbpath = $datadir.'/'.self::$uid.'/migration.db';//!is_null( $dbpath ) ? $dbpath : $datadir.'/'.self::$uid.'/migration.db';
			
			// Prepare options array
			$options = array(
				'portability' => MDB2_PORTABILITY_ALL & (!MDB2_PORTABILITY_FIX_CASE),
				'log_line_break' => '<br>',
				'idxname_format' => '%s',
				'debug' => true,
				'quote_identifier' => true
				);
			$dsn = array(
				'phptype'  => 'sqlite3',
				'database' => self::$dbpath,
				'mode' => '0644'
			);

			// Try to establish connection
			self::$MDB2 = MDB2::factory( $dsn, $options );
			// Die if we could not connect
			if( PEAR::isError( self::$MDB2 )){
				die(self::$MDB2->getMessage());
				OC_Log::write('migration', 'Failed to create/connect to migration.db',OC_Log::FATAL);
				OC_Log::write('migration',self::$MDB2->getUserInfo(),OC_Log::FATAL);
				OC_Log::write('migration',self::$MDB2->getMessage(),OC_Log::FATAL);
				return false;
			} else {
			}
			// We always, really always want associative arrays
			self::$MDB2->setFetchMode(MDB2_FETCHMODE_ASSOC);
		}
		return true;
		
	}
	
	// @breif prepares the db
	// @param $query the sql query to prepare
	public static function prepare( $query ){
		
		// Optimize the query
		$query = self::processQuery( $query );
		
		// Optimize the query
		$query = self::$MDB2->prepare( $query );
		
		// Die if we have an error (error means: bad query, not 0 results!)
		if( PEAR::isError( $query )) {
			$entry = 'DB Error: "'.$result->getMessage().'"<br />';
			$entry .= 'Offending command was: '.$query.'<br />';
			OC_Log::write('migration',$entry,OC_Log::FATAL);
			return false;
		} else {
			return $query;	
		}
		
	}
	
	// @breif processes the db query
	// @param $query the query to process
	// @return string of processed query
	private static function processQuery( $query ){
		
		self::connectDB();
		$prefix = '';
		
		$query = str_replace( '`', '\'', $query );
		$query = str_replace( 'NOW()', 'datetime(\'now\')', $query );
		$query = str_replace( 'now()', 'datetime(\'now\')', $query );

		// replace table name prefix
		$query = str_replace( '*PREFIX*', $prefix, $query );

		return $query;
		
	}
	
	// @brief copys rows to migration.db from the main database
	// @param $options array of options.
	// @return bool
	public static function copyRows( $options ){
		if( !array_key_exists( 'table', $options ) ){
			return false;	
		}
		
		$return = array();
					
		// Need to include 'where' in the query?
		if( array_key_exists( 'matchval', $options ) && array_key_exists( 'matchcol', $options ) ){
			
			// If only one matchval, create an array
			if(!is_array($options['matchval'])){
				$options['matchval'] = array( $options['matchval'] );	
			}
			
			foreach( $options['matchval'] as $matchval ){
				// Run the query for this match value (where x = y value)
				$query = OC_DB::prepare( "SELECT * FROM *PREFIX*" . $options['table'] . " WHERE " . $options['matchcol'] . " LIKE ?" );
				$results = $query->execute( array( $matchval ) );
				$newreturns = self::insertData( $results, $options );
				$return = array_merge( $return, $newreturns );
			}

		} else {
			// Just get everything
			$query = OC_DB::prepare( "SELECT * FROM *PREFIX*" . $options['table'] );
			$results = $query->execute();
			$return = self::insertData( $results, $options );
	
		}
		
		return $return;
		
	}
	
	// @breif saves a sql data set into migration.db
	// @param $data a sql data set returned from self::prepare()->query()
	// @param $options array of copyRows options
	// @return void
	private static function insertData( $data, $options ){
		$return = array();
		while( $row = $data->fetchRow() ){
			// Now save all this to the migration.db
			$fields = array();
			$values = array();
			foreach($row as $field=>$value){
				$fields[] = $field;
				$values[] = $value;
			}
			
			// Generate some sql
			$sql = "INSERT INTO `" . $options['table'] . '` ( `';
			$fieldssql = implode( '`, `', $fields );
			$sql .= $fieldssql . "` ) VALUES( ";
			$valuessql = substr( str_repeat( '?, ', count( $fields ) ),0,-2 );
			$sql .= $valuessql . " )";
			// Make the query
			$query = self::prepare( $sql );
			if(!$query){
				OC_Log::write('migration','Invalid sql produced: '.$sql,OC_Log::FATAL);	
				return false;
				exit();
			} else {
				$query->execute( $values );
				// Do we need to return some values?
				if( array_key_exists( 'idcol', $options ) ){
					// Yes we do
					$return[] = $row[$options['idcol']];	
				} else {
					// Take a guess and return the first field :)
					$return[] = reset($row);	
				}
			}
		}
		return $return;
	}
	
	// @breif creates the tables in migration.db from an apps database.xml
	// @param $appid string id of the app
	// @return bool whether the operation was successful
	private static function createAppTables( $appid ){
			
		if(!self::connectScheme()){
			return false;	
		}
		
		// There is a database.xml file			
		$content = file_get_contents( OC::$SERVERROOT . '/apps/' . $appid . '/appinfo/database.xml' );
		
		$file2 = 'static://db_scheme';
		$content = str_replace( '*dbname*', self::$uid.'/migration', $content );
		$content = str_replace( '*dbprefix*', '', $content );
		
		$xml = new SimpleXMLElement($content);
		foreach($xml->table as $table){
			$tables[] = (string)$table->name;	
		}	
		
		file_put_contents( $file2, $content );
		
		// Try to create tables
		$definition = self::$schema->parseDatabaseDefinitionFile( $file2 );

		unlink( $file2 );
		
		// Die in case something went wrong
		if( $definition instanceof MDB2_Schema_Error ){
			OC_Log::write('migration','Failed to parse database.xml for: '.$appid,OC_Log::FATAL);
			OC_Log::write('migration',$definition->getMessage().': '.$definition->getUserInfo(),OC_Log::FATAL);
			return false;
		}
		
		$definition['overwrite'] = true;
		
		$ret = self::$schema->createDatabase( $definition );
		// Die in case something went wrong
		
		if( $ret instanceof MDB2_Error ){
			OC_Log::write('migration','Failed to create tables for: '.$appid,OC_Log::FATAL);
			OC_Log::write('migration',$ret->getMessage().': '.$ret->getUserInfo(),OC_Log::FATAL);
			return false;
		}
		return $tables;

	}
	
	
	/**
	 * @brief connects to a MDB2 database scheme
	 * @returns true/false
	 *
	 * Connects to a MDB2 database scheme
	 */
	private static function connectScheme(){
		// We need a mdb2 database connection
		self::connectDB();
		self::$MDB2->loadModule( 'Manager' );
		self::$MDB2->loadModule( 'Reverse' );

		// Connect if this did not happen before
		if( !self::$schema ){
			require_once('MDB2/Schema.php');
			self::$schema=MDB2_Schema::factory( self::$MDB2 );
		}

		return true;
	}
	
	// @breif creates a new user in the database
	// @param $uid string user_id of the user to be created
	// @param $hash string hash of the user to be created
	// @return bool result of user creation
	public static function createUser( $uid, $hash ){
		
		// Check if userid exists
		if(OC_User::userExists( $uid )){
			return false;
		}
		
		// Create the user
		$query = OC_DB::prepare( "INSERT INTO `*PREFIX*users` ( `uid`, `password` ) VALUES( ?, ? )" );
		$result = $query->execute( array( $uid, $data['hash']));
		if( !$result ){
			OC_Log::write('migration', 'Failed to create the new user "'.$uid."");	
		}
		return $result ? true : false;
		
	}

}
