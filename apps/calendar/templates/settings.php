<?php
/**
 * Copyright (c) 2011 Bart Visscher <bartv@thisnet.nl>
 * Copyright (c) 2011 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
OC_UTIL::addScript('', 'jquery.multiselect');
OC_UTIL::addStyle('', 'jquery.multiselect');
?>
<form id="calendar">
        <fieldset class="personalblock">
		<table class="nostyle">
			<tr><td><label for="timezone" class="bold"><?php echo $l->t('Timezone');?></label></td><td><select style="display: none;" id="timezone" name="timezone">
                <?php
		$continent = '';
		foreach($_['timezones'] as $timezone):
			if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $timezone ) ):
				$ex=explode('/', $timezone, 2);//obtain continent,city
				if ($continent!=$ex[0]):
					if ($continent!="") echo '</optgroup>';
					echo '<optgroup label="'.$ex[0].'">';
				endif;
				$city=$ex[1];
				$continent=$ex[0];
				echo '<option value="'.$timezone.'"'.($_['timezone'] == $timezone?' selected="selected"':'').'>'.$city.'</option>';
			endif;
                endforeach;?>
                </select></td></tr>

			<tr><td><label for="timeformat" class="bold"><?php echo $l->t('Timeformat');?></label></td><td>
				<select style="display: none;" id="timeformat" title="<?php echo "timeformat"; ?>" name="timeformat">
					<option value="24" id="24h"><?php echo $l->t("24h"); ?></option>
					<option value="ampm" id="ampm"><?php echo $l->t("12h"); ?></option>
				</select>
			</td></tr>

		</table>

		<?php echo $l->t('Calendar CalDAV syncing address:');?> 
  		<?php echo OC_Helper::linkTo('apps/calendar', 'caldav.php', null, true); ?><br />
        </fieldset>
</form>
