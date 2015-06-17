<?php
/** @var OC_L10N $l */
/** @var array $_ */
script('files_sharing', 'settings-personal');
style('files_sharing', 'settings-personal');
script('files_sharing', '3rdparty/gs-share/gs-share');
style('files_sharing', '3rdparty/gs-share/style');
?>

<?php if ($_['outgoingServer2serverShareEnabled']): ?>
	<div id="fileSharingSettings" class="section">
		<h2><?php p($l->t('Federated Cloud')); ?></h2>

		<p>
			<?php p($l->t('Your Federated Cloud ID:')); ?>
			<strong><?php p($_['cloudId']); ?></strong>
		</p>

		<br>

		<p>
			<?php p($l->t('Share it:')); ?>
			<button class="social-gnu" data-url="<?php p($_['reference']); ?>"
				data-title='<?php p(urlencode($_['message_without_URL'])); ?>'
				class='js-gs-share gs-share--icon'>
				GNU Social
			</button>
			<button class="social-diaspora"
				data-url='http://sharetodiaspora.github.io/?title=<?php p($_['message_without_URL']); ?>&url=<?php p($_['reference']); ?>'>
				Diaspora
			</button>
			<button class="social-twitter"
				data-url='https://twitter.com/intent/tweet?text=<?php p(urlencode($_['message_with_URL'])); ?>'>
				Twitter
			</button>
			<button class="social-facebook"
				data-url='https://www.facebook.com/sharer/sharer.php?u=<?php p($_['reference']); ?>'>
				Facebook
			</button>
			<button class="social-googleplus"
				data-url='https://plus.google.com/share?url=<?php p($_['reference']); ?>'/>
				Google+
			</button>
		</p>

		<br>

		<p>
			<?php p($l->t('Add it to your website:')); ?>

			<a target="_blank" href="<?php p($_['reference']); ?>">
				<img src="img/social-owncloud.svg" />
				<?php p($l->t('Share with me via ownCloud')); ?>
			</a>
		</p>

		<p>
			<?php p($l->t('HTML Code:')); ?>
			<xmp><a target="_blank" href="<?php p($_['reference']); ?>">
	<img src="../img/social-owncloud.svg" />
	<?php p($l->t('Share with me via ownCloud')); ?>

</a></xmp>
		</p>

	</div>
<?php endif; ?>
