<div id="controls">
	<?php if($_['admin']) { ?>
		<a class="button newquestion <?php echo($_['style1']); ?>"
			href="<?php echo($_['url1']); ?>"><?php echo $l->t( 'User Documentation' ); ?></a>
		<a class="button newquestion <?php echo($_['style2']); ?>"
			href="<?php echo($_['url2']); ?>"><?php echo $l->t( 'Administrator Documentation' ); ?></a>
	<?php } ?>
	<a class="button newquestion" href="http://owncloud.org/support" target="_blank"><?php
		echo $l->t( 'Online Documentation' ); ?></a>
	<a class="button newquestion" href="http://forum.owncloud.org" target="_blank"><?php
		echo $l->t( 'Forum' ); ?></a>
	<?php if($_['admin']) { ?>
		<a class="button newquestion" href="https://github.com/owncloud/core/blob/master/CONTRIBUTING.md" target="_blank"><?php
			echo $l->t( 'Bugtracker' ); ?></a>
	<?php } ?>
	<a class="button newquestion" href="http://owncloud.com" target="_blank"><?php
		echo $l->t( 'Commercial Support' ); ?></a>
</div>
<div class="help-includes">
	<iframe src="<?php echo($_['url']); ?>" class="help-iframe">abc</iframe>
</div>
