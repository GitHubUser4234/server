<?php
/**
 * Copyright (c) 2012, Tom Needham <tom@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */
?>
<div id="oauth-request" class="guest-container">
	<p><strong><?php p($_['consumer']['name']); ?></strong> is requesting your permission to read, write, modify and delete data from the following apps:</p>
	<ul>
		<?php
		// Foreach requested scope
		foreach($_['consumer']['scopes'] as $app){
			print_unescaped('<li>'.OC_Util:sanitzeHTML($app).'</li>)';
		}
		?>
	</ul>
	<a href="#" class="button">Allow</a>
	<a href="#" class="button">Disallow</a>
</div>
