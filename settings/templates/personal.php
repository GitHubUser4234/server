<div id="quota" class="personalblock"><div style="width:<?php echo $_['usage_relative'] ?>%;">
	<p><?php echo $l->t( 'You\'re currently using' );?> <strong><?php echo $_['usage_relative'] ?>%</strong> (<?php echo $_['usage'] ?>) <?php echo $l->t( 'of your' );?> <?php echo $_['total_space'] ?> <?php echo $l->t( 'space' );?>.</p>
</div></div>

<form id="passwordform">
	<fieldset class="personalblock">
		<div id="passwordchanged"><?php echo $l->t( 'Your password got changed');?></div>
		<div id="passworderror"></div>
		<input type="password" id="pass1" name="oldpassword" placeholder="<?php echo $l->t( 'Old password' );?>" />
		<input type="password" id="pass2" name="password" placeholder="<?php echo $l->t( 'New password' );?>" data-typetoggle="#show" />
		<input type="checkbox" id="show" name="show" /><label for="show"><?php echo $l->t( 'show' );?></label>
		<input id="passwordbutton" type="submit" value="<?php echo $l->t( 'Change Password' );?>" />
	</fieldset>
</form>

<div class="personalblock">
	<label for="languageinput"><?php echo $l->t( 'Language' );?></label>
	<select id="languageinput" name='lang'>
	<?php foreach($_['languages'] as $language):?>
		<option value='<?php echo $language;?>'><?php echo $language;?></option>
	<?php endforeach;?>
	</select>

	<?php foreach($_['forms'] as $form){
		echo $form;
	};?>
</div>
