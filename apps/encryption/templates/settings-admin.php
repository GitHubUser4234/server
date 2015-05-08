<?php
/** @var array $_ */
/** @var OC_L10N $l */
script('encryption', 'settings-admin');
script('core', 'multiselect');
style('encryption', 'settings-admin');
?>
<form id="ocDefaultEncryptionModule" class="sub-section">
	<?php if(!$_["initStatus"]): ?>
		<?php p($l->t("Encryption App is enabled but your keys are not initialized, please log-out and log-in again")); ?>
	<?php else: ?>
	<p id="encryptionSetRecoveryKey">
		<?php $_["recoveryEnabled"] === '0' ?  p($l->t("Enable recovery key")) : p($l->t("Disable recovery key")); ?>
		<span class="msg"></span>
		<br/>
		<em>
		<?php p($l->t("The recovery key is an extra encryption key that is used
		to encrypt files. It allows recovery of a user's files if the user forgets their password.")) ?>
		</em>
		<br/>
		<input type="password"
			   name="encryptionRecoveryPassword"
			   id="encryptionRecoveryPassword"
			   placeholder="<?php p($l->t("Recovery key password")); ?>"/>
		<input type="password"
			   name="encryptionRecoveryPassword"
			   id="repeatEncryptionRecoveryPassword"
			   placeholder="<?php p($l->t("Repeat recovery key password")); ?>"/>
		<input type="button"
			   name="enableRecoveryKey"
			   id="enableRecoveryKey"
			   status="<?php p($_["recoveryEnabled"]) ?>"
			   value="<?php $_["recoveryEnabled"] === '0' ?  p($l->t("Enable recovery key")) : p($l->t("Disable recovery key")); ?>"/>
	</p>
	<br/><br/>

	<p name="changeRecoveryPasswordBlock" id="encryptionChangeRecoveryKey" <?php if($_['recoveryEnabled'] === '0') print_unescaped('class="hidden"');?>>
		<?php p($l->t("Change recovery key password:")); ?>
		<span class="msg"></span>
		<br/>
		<input
			type="password"
			name="changeRecoveryPassword"
			id="oldEncryptionRecoveryPassword"
			placeholder="<?php p($l->t("Old recovery key password")); ?>"/>
		<br />
		<input
			type="password"
			name="changeRecoveryPassword"
			id="newEncryptionRecoveryPassword"
			placeholder="<?php p($l->t("New recovery key password")); ?>"/>
		<input
			type="password"
			name="changeRecoveryPassword"
			id="repeatedNewEncryptionRecoveryPassword"
			placeholder="<?php p($l->t("Repeat new recovery key password")); ?>"/>

		<button
			type="button"
			name="submitChangeRecoveryKey">
				<?php p($l->t("Change Password")); ?>
		</button>
	</p>
	<?php endif; ?>
</form>
