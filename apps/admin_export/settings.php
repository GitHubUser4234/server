<?php

/**
 * ownCloud - admin export
 *
 * @author Thomas Schmidt
 * @copyright 2011 Thomas Schmidt tom@opensuse.org
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
OC_Util::checkAdminUser();
OC_Util::checkAppEnabled('admin_export');

define('DS', '/');


// Export?
if (isset($_POST['admin_export'])) {
	// Create the export zip
	if( !$path = OC_Migrate::createSysExportFile( $_POST['export_type'] ) ){
		// Error
		die('error');	
	} else {
		// Download it
		header("Content-Type: application/zip");
		header("Content-Disposition: attachment; filename=" . basename($path));
		header("Content-Length: " . filesize($path));
		@ob_end_clean();
		readfile( $path );
		unlink( $path );
	}
// Import?
} else if( isset($_POST['admin_import']) ){
	
	$root = OC::$SERVERROOT . "/";
	$importname = "owncloud_import_" . date("y-m-d_H-i-s");
	
	// Save data dir for later
	$datadir = OC_Config::getValue( 'datadirectory' );
	
	// Copy the uploaded file
	$from = $_FILES['owncloud_import']['tmp_name'];
	$to = get_temp_dir().'/'.$importname.'.zip';
	if( !move_uploaded_file( $from, $to ) ){
		OC_Log::write('admin_export',"Failed to copy the uploaded file",OC_Log::INFO);
		exit();		
	}
	
	// Extract zip
	$zip = new ZipArchive();
	if ($zip->open(get_temp_dir().'/'.$importname.'.zip') != TRUE) {
		OC_Log::write('admin_export',"Failed to open zip file",OC_Log::INFO);
		exit();
	}
	$zip->extractTo(get_temp_dir().'/'.$importname.'/');
	$zip->close();
	
	// Delete uploaded file
	unlink( get_temp_dir() . '/' . $importname . '.zip' );
	
	// Now we need to check if everything is present. Data and dbexport.xml
	
	
	// Delete current data folder.
	OC_Log::write('admin_export',"Deleting current data dir",OC_Log::INFO);
	unlinkRecursive( $datadir, false );
	
	// Copy over data
	if( !copy_r( get_temp_dir() . '/' . $importname . '/data', $datadir ) ){
		OC_Log::write('admin_export',"Failed to copy over data directory",OC_Log::INFO);
		exit();	
	}
	
	OC_DB::replaceDB( get_temp_dir() . '/' . $importname . '/dbexport.xml' );
		
} else {
// fill template
    $tmpl = new OC_Template('admin_export', 'settings');
    return $tmpl->fetchPage();
}

function zipAddDir($dir, $zip, $recursive=true, $internalDir='') {
    $dirname = basename($dir);
    $zip->addEmptyDir($internalDir . $dirname);
    $internalDir.=$dirname.='/';

    if ($dirhandle = opendir($dir)) {
		while (false !== ( $file = readdir($dirhandle))) {

			if (( $file != '.' ) && ( $file != '..' )) {

			if (is_dir($dir . '/' . $file) && $recursive) {
				zipAddDir($dir . '/' . $file, $zip, $recursive, $internalDir);
			} elseif (is_file($dir . '/' . $file)) {
				$zip->addFile($dir . '/' . $file, $internalDir . $file);
			}
			}
		}
		closedir($dirhandle);
    } else {
		OC_Log::write('admin_export',"Was not able to open directory: " . $dir,OC_Log::ERROR);
    }
}

function unlinkRecursive($dir, $deleteRootToo) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        { 
            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 

    closedir($dh); 
    
    if ($deleteRootToo) 
    { 
        @rmdir($dir); 
    } 
    
    return; 
} 
 

    function copy_r( $path, $dest )
    {
        if( is_dir($path) )
        {
            @mkdir( $dest );
            $objects = scandir($path);
            if( sizeof($objects) > 0 )
            {
                foreach( $objects as $file )
                {
                    if( $file == "." || $file == ".." )
                        continue;
                    // go on
                    if( is_dir( $path.DS.$file ) )
                    {
                        copy_r( $path.DS.$file, $dest.DS.$file );
                    }
                    else
                    {
                        copy( $path.DS.$file, $dest.DS.$file );
                    }
                }
            }
            return true;
        }
        elseif( is_file($path) )
        {
            return copy($path, $dest);
        }
        else
        {
            return false;
        }
    }
