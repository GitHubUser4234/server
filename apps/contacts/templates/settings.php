<form id="mediaform">
	<fieldset class="personalblock">
		<strong><?php echo $l->t('Contacts'); ?></strong><br />
		<?php echo $l->t('CardDAV syncing address:'); ?>
		<?php echo OC_Helper::linkToAbsolute('contacts', 'carddav.php'); ?><br />
	</fieldset>
</form>
