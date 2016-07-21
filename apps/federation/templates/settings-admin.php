<?php
/** @var array $_ */
use OCA\Federation\TrustedServers;

/** @var OC_L10N $l */
script('federation', 'settings-admin');
style('federation', 'settings-admin')
?>
<div id="ocFederationSettings" class="section">
	<h2><?php p($l->t('Federation')); ?></h2>
	<em><?php p($l->t('Federation allows you to connect with other trusted servers to exchange the user directory. For example this will be used to auto-complete external users for federated sharing.')); ?></em>

	<p>
		<input id="autoAddServers" type="checkbox" class="checkbox" <?php if($_['autoAddServers']) p('checked'); ?> />
		<label for="autoAddServers"><?php p($l->t('Add server automatically once a federated share was created successfully')); ?></label>
	</p>

	<h3><?php p($l->t('Trusted Servers')); ?></h3>
	<p id="ocFederationAddServer">
		<button id="ocFederationAddServerButton" class=""><?php p($l->t('+ Add Nextcloud server')); ?></button>
		<input id="serverUrl" class="hidden" type="text" value="" placeholder="<?php p($l->t('Nextcloud Server')); ?>" name="server_url"/>
		<span class="msg"></span>
	</p>
	<ul id="listOfTrustedServers">
		<?php foreach($_['trustedServers'] as $trustedServer) { ?>
			<li id="<?php p($trustedServer['id']); ?>">
				<?php if((int)$trustedServer['status'] === TrustedServers::STATUS_OK) { ?>
					<span class="status success"></span>
				<?php
				} elseif(
					(int)$trustedServer['status'] === TrustedServers::STATUS_PENDING ||
					(int)$trustedServer['status'] === TrustedServers::STATUS_ACCESS_REVOKED
				) { ?>
					<span class="status indeterminate"></span>
				<?php } else {?>
					<span class="status error"></span>
				<?php } ?>
				<?php p($trustedServer['url']); ?>
				<span class="icon icon-delete"></span>
			</li>
		<?php } ?>
	</ul>

</div>

