<!--[if IE 8]><style>input[type="checkbox"]{padding:0;}table td{position:static !important;}</style><![endif]-->
<div id="controls">
	<?php echo($_['breadcrumb']); ?>
		<div id="file_action_panel"></div>
</div>
<div id='notification'></div>

<?php if (isset($_['files']) and $_['isCreatable'] and count($_['files'])==0):?>
	<div id="emptyfolder"><?php echo $l->t('Nothing in here. Upload something!')?></div>
<?php endif; ?>

<table>
	<thead>
		<tr>
			<th id='headerName'>
				<input type="checkbox" id="select_all" />
				<span class='name'><?php echo $l->t( 'Name' ); ?></span>
				<span class='selectedActions'>
					<?php if($_['allowZipDownload']) : ?>
						<a href="" class="download">
							<img class="svg" alt="Download"
								 src="<?php echo OCP\image_path("core", "actions/download.svg"); ?>" />
							<?php echo $l->t('Download')?>
						</a>
					<?php endif; ?>
				</span>
			</th>
			<th id="headerDate">
				<span id="modified"><?php echo $l->t( 'Deleted' ); ?></span>
			</th>
		</tr>
	</thead>
	<tbody id="fileList">
		<?php echo($_['fileList']); ?>
	</tbody>
</table>
