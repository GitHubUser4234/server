<?php

use OCP\NamespaceName;

/**
 * Class BadClass - creating an instance of a blacklisted class is not allowed
 */
class BadClass {
	public function test() {
		return NamespaceName\ClassName::CONSTANT_NAME;
	}
}
