<div id="controls">
	<div id="file_action_panel"></div>
</div>
<div id='notification'></div>

<div id="emptycontent" class="hidden"><?php p($l->t('Nothing in here. Your trash bin is empty!'))?></div>

<input type="hidden" id="permissions" value="0"></input>
<input type="hidden" id="disableSharing" data-status="<?php p($_['disableSharing']); ?>"></input>
<input type="hidden" name="dir" value="<?php p($_['dir']) ?>" id="dir">

<table id="filestable">
	<thead>
		<tr>
			<th id='headerName' class="hidden column-name">
				<div id="headerName-container">
					<input type="checkbox" id="select_all" />
					<label for="select_all"></label>
					<a class="name sort columntitle" data-sort="name"><span><?php p($l->t( 'Name' )); ?></span><span class="sort-indicator"></span></a>
					<span id="selectedActionsList" class='selectedActions'>
						<a href="" class="undelete">
							<img class="svg" alt="<?php p($l->t( 'Restore' )); ?>"
								 src="<?php print_unescaped(OCP\image_path("core", "actions/history.svg")); ?>" />
							<?php p($l->t('Restore'))?>
						</a>
					</span>
				</div>
			</th>
			<th id="headerDate" class="hidden column-mtime">
				<a id="modified" class="columntitle" data-sort="mtime"><span><?php p($l->t( 'Deleted' )); ?></span><span class="sort-indicator"></span></a>
				<span class="selectedActions">
					<a href="" class="delete-selected">
						<?php p($l->t('Delete'))?>
						<img class="svg" alt="<?php p($l->t('Delete'))?>"
							src="<?php print_unescaped(OCP\image_path("core", "actions/delete.svg")); ?>" />
					</a>
				</span>
			</th>
		</tr>
	</thead>
	<tbody id="fileList">
	</tbody>
	<tfoot>
	</tfoot>
</table>
