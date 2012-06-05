<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

abstract class Test_Cache extends UnitTestCase {
	/**
	 * @var OC_Cache cache;
	 */
	protected $instance;

	public function tearDown(){
		$this->instance->clear();
	}

	function testSimple(){
		$this->assertNull($this->instance->get('value1'));
		
		$value='foobar';
		$this->instance->set('value1',$value);
		$received=$this->instance->get('value1');
		$this->assertEqual($value,$received,'Value recieved from cache not equal to the original');
		$value='ipsum lorum';
		$this->instance->set('value1',$value);
		$received=$this->instance->get('value1');
		$this->assertEqual($value,$received,'Value not overwritten by seccond set');

		$value2='foobar';
		$this->instance->set('value2',$value2);
		$received2=$this->instance->get('value2');
		$this->assertEqual($value,$received,'Value changed while setting other variable');
		$this->assertEqual($value2,$received2,'Seccond value not equal to original');

		$this->assertNull($this->instance->get('not_set'),'Unset value not equal to null');
	}

	function testTTL(){
	}
}