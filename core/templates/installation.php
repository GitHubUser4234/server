<input type='hidden' id='hasMySQL' value='<?php echo $_['hasMySQL'] ?>'>
<input type='hidden' id='hasSQLite' value='<?php echo $_['hasSQLite'] ?>'>
<input type='hidden' id='hasPostgreSQL' value='<?php echo $_['hasPostgreSQL'] ?>'>
<input type='hidden' id='hasOracle' value='<?php echo $_['hasOracle'] ?>'>
<form action="index.php" method="post">
<input type="hidden" name="install" value="true" />
	<?php if(count($_['errors']) > 0): ?>
	<ul class="errors">
		<?php foreach($_['errors'] as $err): ?>
		<li>
			<?php if(is_array($err)):?>
				<?php print $err['error']; ?>
				<p class='hint'><?php print $err['hint']; ?></p>
			<?php else: ?>
				<?php print $err; ?>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<?php if(!$_['secureRNG']): ?>
	<fieldset class="warning">
		<legend><strong><?php echo $l->t('Security Warning');?></strong></legend>
		<span><?php echo $l->t('No secure random number generator is available, please enable the PHP OpenSSL extension.');?></span>		
		<br/>
		<span><?php echo $l->t('Without a secure random number generator an attacker may be able to predict password reset tokens and take over your account.');?></span>		
	</fieldset>
	<?php endif; ?>
	<?php if(!$_['htaccessWorking']): ?>
	<fieldset class="warning">
		<legend><strong><?php echo $l->t('Security Warning');?></strong></legend>
		<p><?php echo $l->t('Your data directory and files are probably accessible from the internet because the .htaccess file does not work.');?><br>
		<?php echo $l->t('For information how to properly configure your server, please see the <a href="http://doc.owncloud.org/server/5.0/admin_manual/installation.html" target="_blank">documentation</a>.');?></p>
	</fieldset>
	<?php endif; ?>
	<fieldset id="adminaccount">
		<legend><?php echo $l->t( 'Create an <strong>admin account</strong>' ); ?></legend>
		<p class="infield grouptop">
			<input type="text" name="adminlogin" id="adminlogin" value="<?php print OC_Helper::init_var('adminlogin'); ?>" autocomplete="off" autofocus required />
			<label for="adminlogin" class="infield"><?php echo $l->t( 'Username' ); ?></label>
			<img class="svg" src="<?php echo image_path('', 'actions/user.svg'); ?>" alt="" />
		</p>
		<p class="infield groupbottom">
			<input type="password" name="adminpass" id="adminpass" value="<?php print OC_Helper::init_var('adminpass'); ?>" required data-typetoggle="#show" />
			<label for="adminpass" class="infield"><?php echo $l->t( 'Password' ); ?></label>
			<img class="svg" id="adminpass-icon" src="<?php echo image_path('', 'actions/password.svg'); ?>" alt="" />
			<input type="checkbox" id="show" name="show" />
			<label for="show"></label>
		</p>
	</fieldset>

	<fieldset id="datadirField">
		<legend><a id="showAdvanced"><?php echo $l->t( 'Advanced' ); ?> ▾</a></legend>
		<div id="datadirContent">
			<label for="directory"><?php echo $l->t( 'Data folder' ); ?></label>
			<input type="text" name="directory" id="directory" value="<?php print OC_Helper::init_var('directory', $_['directory']); ?>" />
		</div>
	</fieldset>

	<fieldset id='databaseField'>
		<?php if($_['hasMySQL'] or $_['hasPostgreSQL'] or $_['hasOracle']) $hasOtherDB = true; else $hasOtherDB =false; //other than SQLite ?>
		<legend><?php echo $l->t( 'Configure the database' ); ?></legend>
		<div id="selectDbType">
		<?php if($_['hasSQLite']): ?>
		<input type='hidden' id='hasSQLite' value="true" />
		<?php if(!$hasOtherDB): ?>
		<p>SQLite <?php echo $l->t( 'will be used' ); ?>.</p>
		<input type="hidden" id="dbtype" name="dbtype" value="sqlite" />
		<?php else: ?>
		<input type="radio" name="dbtype" value="sqlite" id="sqlite" <?php OC_Helper::init_radio('dbtype', 'sqlite', 'sqlite'); ?>/>
		<label class="sqlite" for="sqlite">SQLite</label>
		<?php endif; ?>
		<?php endif; ?>

		<?php if($_['hasMySQL']): ?>
		<input type='hidden' id='hasMySQL' value='true'/>
		<?php if(!$_['hasSQLite'] and !$_['hasPostgreSQL'] and !$_['hasOracle']): ?>
		<p>MySQL <?php echo $l->t( 'will be used' ); ?>.</p>
		<input type="hidden" id="dbtype" name="dbtype" value="mysql" />
		<?php else: ?>
		<input type="radio" name="dbtype" value="mysql" id="mysql" <?php OC_Helper::init_radio('dbtype', 'mysql', 'sqlite'); ?>/>
		<label class="mysql" for="mysql">MySQL</label>
		<?php endif; ?>
		<?php endif; ?>

		<?php if($_['hasPostgreSQL']): ?>
		<?php if(!$_['hasSQLite'] and !$_['hasMySQL'] and !$_['hasOracle']): ?>
		<p>PostgreSQL <?php echo $l->t( 'will be used' ); ?>.</p>
		<input type="hidden" id="dbtype" name="dbtype" value="pgsql" />
		<?php else: ?>
		<label class="pgsql" for="pgsql">PostgreSQL</label>
		<input type="radio" name="dbtype" value='pgsql' id="pgsql" <?php OC_Helper::init_radio('dbtype', 'pgsql', 'sqlite'); ?>/>
		<?php endif; ?>
		<?php endif; ?>

		<?php if($_['hasOracle']): ?>
		<?php if(!$_['hasSQLite'] and !$_['hasMySQL'] and !$_['hasPostgreSQL']): ?>
		<p>Oracle <?php echo $l->t( 'will be used' ); ?>.</p>
		<input type="hidden" id="dbtype" name="dbtype" value="oci" />
		<?php else: ?>
		<label class="oci" for="oci">Oracle</label>
		<input type="radio" name="dbtype" value='oci' id="oci" <?php OC_Helper::init_radio('dbtype', 'oci', 'sqlite'); ?>/>
		<?php endif; ?>
		<?php endif; ?>
		</div>

		<?php if($hasOtherDB): ?>
		<div id="use_other_db">
			<p class="infield grouptop">
				<label for="dbuser" class="infield"><?php echo $l->t( 'Database user' ); ?></label>
				<input type="text" name="dbuser" id="dbuser" value="<?php print OC_Helper::init_var('dbuser'); ?>" autocomplete="off" />
			</p>
			<p class="infield groupmiddle">
				<label for="dbpass" class="infield"><?php echo $l->t( 'Database password' ); ?></label>
				<input type="password" name="dbpass" id="dbpass" value="<?php print OC_Helper::init_var('dbpass'); ?>" />
			</p>
			<p class="infield groupmiddle">
				<label for="dbname" class="infield"><?php echo $l->t( 'Database name' ); ?></label>
				<input type="text" name="dbname" id="dbname" value="<?php print OC_Helper::init_var('dbname'); ?>" autocomplete="off" pattern="[0-9a-zA-Z$_-]+" />
			</p>
		</div>
		<?php endif; ?>
		<?php if($_['hasOracle']): ?>
		<div id="use_oracle_db">
			<p class="infield groupmiddle">
				<label for="dbtablespace" class="infield"><?php echo $l->t( 'Database tablespace' ); ?></label>
				<input type="text" name="dbtablespace" id="dbtablespace" value="<?php print OC_Helper::init_var('dbtablespace'); ?>" autocomplete="off" />
			</p>
		</div>
		<?php endif; ?>
		<p class="infield groupbottom">
			<label for="dbhost" class="infield" id="dbhostlabel"><?php echo $l->t( 'Database host' ); ?></label>
			<input type="text" name="dbhost" id="dbhost" value="<?php print OC_Helper::init_var('dbhost', 'localhost'); ?>" />
		</p>
	</fieldset>

	<div class="buttons"><input type="submit" class="primary" value="<?php echo $l->t( 'Finish setup' ); ?>" /></div>
</form>
