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
                <label for="timezone"><strong><?php echo $l->t('Timezone');?></strong></label>
		<select style="display: none;" id="timezone" name="timezone">
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
                </select>&nbsp;&nbsp;
		<label for="timeformat"><strong><?php echo $l->t('Timeformat');?></strong></label>
		<select style="display: none;" id="timeformat" title="<?php echo "timeformat"; ?>" name="timeformat">
			<option value="24" id="24h"><?php echo $l->t("24h"); ?></option>
			<option value="ampm" id="ampm"><?php echo $l->t("12h"); ?></option>
		</select><br />
		<label for="firstdayofweek"><strong><?php echo $l->t('First day of the week');?></strong></label>
		<select style="display: none;" id="firstdayofweek" name="firstdayofweek">
		<?php
		$weekdays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		for($i = 0;$i <= 6;$i++){
			echo '<option value="'.$i.'" id="select_'.$i.'">' . $l->t($weekdays[$i]) . '</option>';
		}
		?>
		</select><br />
		<label for="weekend"><strong><?php echo $l->t('Days of weekend');?></strong></label>
		<select id="weekend" name="weekend[]" style="width: 50%;" multiple="multiple" title="<?php echo $l->t("Weekend"); ?>">
		<?php
		$weekdays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		for($i = 0;$i <= 6;$i++){
			echo '<option value="'.$weekdays[$i].'" id="selectweekend_' . $weekdays[$i] . '">' . $l->t($weekdays[$i]) . '</option>';
		}
		?>
		</select><br />
		<label for="duration"><strong><?php echo $l->t('Event duration');?></strong></label>
		<input type="text" maxlength="3" size="3" style="width: 2em;" id="duration" name="duration" /> <?php echo $l->t("Minutes");?>
		<br />
		<?php echo $l->t('Calendar CalDAV syncing address:');?> 
  		<?php echo OC_Helper::linkTo('apps/calendar', 'caldav.php', null, true); ?><br />
        </fieldset>
</form>
