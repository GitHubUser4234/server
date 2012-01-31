<ul>
	<li><a href="#tabs-1">Eventinfo</a></li>
	<li><a href="#tabs-2">Repeating</a></li>
	<li><a href="#tabs-3">Attendees</a></li>
</ul>
<div id="tabs-1">
	<table width="100%">
		<tr>
			<th width="75px"><?php echo $l->t("Title");?>:</th>
			<td>
				<input type="text" style="width:350px;" size="100" placeholder="<?php echo $l->t("Title of the Event");?>" value="<?php echo isset($_['title']) ? $_['title'] : '' ?>" maxlength="100" name="title"/>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<th width="75px"><?php echo $l->t("Category");?>:</th>
			<td>
				<select id="category" name="categories[]" multiple="multiple" title="<?php echo $l->t("Select category") ?>">
					<?php
					if (!isset($_['categories'])) {$_['categories'] = array();}
					echo html_select_options($_['category_options'], $_['categories'], array('combine'=>true));
					?>
				</select>
			</td>
			<th width="75px">&nbsp;&nbsp;&nbsp;<?php echo $l->t("Calendar");?>:</th>
			<td>
				<select style="width:140px;" name="calendar">
					<?php
					if (!isset($_['calendar'])) {$_['calendar'] = false;}
					echo html_select_options($_['calendar_options'], $_['calendar'], array('value'=>'id', 'label'=>'displayname'));
					?>
				</select>
			</td>
		</tr>
	</table>
	<hr>
	<table width="100%">
		<tr>
			<th width="75px"></th>
			<td>
				<input onclick="Calendar.UI.lockTime();" type="checkbox"<?php if($_['allday']){echo 'checked="checked"';} ?> id="allday_checkbox" name="allday">
				<label for="allday_checkbox"><?php echo $l->t("All Day Event");?></label>
			</td>
		</tr>
		<tr>
			<th width="75px"><?php echo $l->t("From");?>:</th>
			<td>
				<input type="text" value="<?php echo $_['startdate'];?>" name="from" id="from">
				&nbsp;&nbsp;
				<input type="time" value="<?php echo $_['starttime'];?>" name="fromtime" id="fromtime">
			</td>
		</tr>
		<tr>
			<th width="75px"><?php echo $l->t("To");?>:</th>
			<td>
				<input type="text" value="<?php echo $_['enddate'];?>" name="to" id="to">
				&nbsp;&nbsp;
				<input type="time" value="<?php echo $_['endtime'];?>" name="totime" id="totime">
			</td>
		</tr>
	</table>
	<input type="button" class="submit" value="<?php echo $l->t("Advanced options"); ?>" onclick="Calendar.UI.showadvancedoptions();" id="advanced_options_button">
	<div id="advanced_options" style="display: none;">
		<hr>
		<table>
			<tr>
				<th width="85px"><?php echo $l->t("Location");?>:</th>
				<td>
					<input type="text" style="width:350px;" size="100" placeholder="<?php echo $l->t("Location of the Event");?>" value="<?php echo isset($_['location']) ? $_['location'] : '' ?>" maxlength="100"  name="location" />
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<th width="85px" style="vertical-align: top;"><?php echo $l->t("Description");?>:</th>
				<td>
					<textarea style="width:350px;height: 150px;" placeholder="<?php echo $l->t("Description of the Event");?>" name="description"><?php echo isset($_['description']) ? $_['description'] : '' ?></textarea>
				</td>
			</tr>
		</table>
	</div>
	</div>
<div id="tabs-2">
	<table style="width:100%">
			<tr>
				<th width="75px"><?php echo $l->t("Repeat");?>:</th>
				<td>
				<select id="repeat" name="repeat">
					<?php
					echo html_select_options($_['repeat_options'], $_['repeat']);
					?>
				</select></td>
				<td><input type="button" style="float:right;" class="submit" value="<?php echo $l->t("Advanced"); ?>" onclick="Calendar.UI.showadvancedoptionsforrepeating();" id="advanced_options_button"></td>
			</tr>
		</table>
		<div id="advanced_options_repeating" style="display:none;">
			<table style="width:100%">
				<tr id="advanced_month" style="display:none;">
					<th width="75px"></th>
					<td>
						<select id="advanced_month_select" name="advanced_month_select">
							<?php
							echo html_select_options($_['repeat_month_options'], $_['repeat_month']);
							?>
						</select>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_year" style="display:none;">
					<th width="75px"></th>
					<td>
						<select id="advanced_year_select" name="advanced_year_select">
							<?php
							echo html_select_options($_['repeat_year_options'], $_['repeat_year']);
							?>
						</select>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_weekofmonth" style="display:none;">
					<th width="75px"></th>
					<td id="weekofmonthcheckbox">
						<select id="weekofmonthoptions" name="weekofmonthoptions">
							<?php
							echo html_select_options($_['repeat_weekofmonth_options'], $_['repeat_weekofmonth']);
							?>
						</select>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_weekday" style="display:none;">
					<th width="75px"></th>
					<td id="weeklycheckbox">
						<select id="weeklyoptions" name="weeklyoptions[]" multiple="multiple" title="<?php echo $l->t("Select weekdays") ?>">
							<?php
							if (!isset($_['weekdays'])) {$_['weekdays'] = array();}
							echo html_select_options($_['repeat_weekly_options'], $_['repeat_weekdays'], array('combine'=>true));
							?>
						</select>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_byyearday" style="display:none;">
					<th width="75px"></th>
					<td id="byyeardaycheckbox">
						<select id="byyearday" name="byyearday[]" multiple="multiple" title="<?php echo $l->t("Select days") ?>">
							<?php
							if (!isset($_['repeat_byyearday'])) {$_['repeat_byyearday'] = array();}
							echo html_select_options($_['repeat_byyearday_options'], $_['repeat_byyearday'], array('combine'=>true));
							?>
						</select><?php echo $l->t('and the events day of year.'); ?>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_bymonthday" style="display:none;">
					<th width="75px"></th>
					<td id="bymonthdaycheckbox">
						<select id="bymonthday" name="bymonthday[]" multiple="multiple" title="<?php echo $l->t("Select days") ?>">
							<?php
							if (!isset($_['repeat_bymonthday'])) {$_['repeat_bymonthday'] = array();}
							echo html_select_options($_['repeat_bymonthday_options'], $_['repeat_bymonthday'], array('combine'=>true));
							?>
						</select><?php echo $l->t('and the events day of month.'); ?>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_bymonth" style="display:none;">
					<th width="75px"></th>
					<td id="bymonthcheckbox">
						<select id="bymonth" name="bymonth[]" multiple="multiple" title="<?php echo $l->t("Select months") ?>">
							<?php
							if (!isset($_['repeat_bymonth'])) {$_['repeat_bymonth'] = array();}
							echo html_select_options($_['repeat_bymonth_options'], $_['repeat_bymonth'], array('combine'=>true));
							?>
						</select>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr id="advanced_byweekno" style="display:none;">
					<th width="75px"></th>
					<td id="bymonthcheckbox">
						<select id="byweekno" name="byweekno[]" multiple="multiple" title="<?php echo $l->t("Select weeks") ?>">
							<?php
							if (!isset($_['repeat_byweekno'])) {$_['repeat_byweekno'] = array();}
							echo html_select_options($_['repeat_byweekno_options'], $_['repeat_byweekno'], array('combine'=>true));
							?>
						</select><?php echo $l->t('and the events week of year.'); ?>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr>
					<th width="75px"><?php echo $l->t('Interval'); ?>:</th>
					<td>
						<input style="width:350px;" type="number" min="1" size="4" max="1000" value="<?php echo isset($_['repeat_interval']) ? $_['repeat_interval'] : '1'; ?>" name="interval">
					</td>
				</tr>
				<tr>
					<th width="75px"><?php echo $l->t('End'); ?>:</th>
					<td>
						<select id="end" name="end">
							<?php
							echo html_select_options($_['repeat_end_options'], $_['repeat_end']); 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th></th>
					<td id="byoccurrences" style="display:none;">
						<input type="number" min="1" max="99999" id="until_count" name="byoccurrences" value="<?php echo $_['repeat_count']; ?>"><?php echo $l->t('occurrences'); ?>
					</td>
				</tr>
				<tr>
					<th></th>
					<td id="bydate" style="display:none;">
						<input type="text" name="bydate" value="<?php echo $_['repeat_date']; ?>">
					</td>
				</tr>
			</table>
			<?php echo $l->t('Summary'); ?>:<span id="repeatsummary"></span>
		</div>
</div>
<div id="tabs-3"></div>