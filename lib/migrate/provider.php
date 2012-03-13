<?php
/**
 * provides search functionalty
 */
abstract class OC_Migrate_Provider{
	
	public $id;
	
	public function __construct( $appid ){
		$this->id = $appid;
		OC_Migrate::registerProvider( $this );
	}
	
	/**
	 * @breif exports data for apps
	 * @param string $uid
	 * @return array appdata to be exported
	 */
	abstract function export($uid);
	
	/**
	 * @breif imports data for the app
	 * @param $info array of info including exportinfo.json
	 * @return void
	 */
	abstract function import( $info );
}
