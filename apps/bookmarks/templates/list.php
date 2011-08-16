<input type="hidden" id="bookmarkFilterTag" value="<?php echo htmlentities($_GET['tag']); ?>" />
<h2 class="bookmarks_headline"><?php echo isset($_GET["tag"]) ? 'Bookmarks with tag: ' . urldecode($_GET["tag"]) : 'All bookmarks'; ?></h2>
<div class="bookmarks_menu">
	<input type="button" class="bookmarks_addBtn" value="Add Bookmark" />
</div>
<div class="bookmarks_add">
	<p><label class="bookmarks_label">Address</label><input type="text" id="bookmark_add_url" class="bookmarks_input" /></p>
	<p><label class="bookmarks_label">Title</label><input type="text" id="bookmark_add_title" class="bookmarks_input" /></p>
	<p><label class="bookmarks_label">Description</label><input type="text" id="bookmark_add_description" class="bookmarks_input" /></p>
	<p><label class="bookmarks_label">Tags</label><input type="text" id="bookmark_add_tags" class="bookmarks_input" /></p>
	<p><label class="bookmarks_label"></label><input type="submit" id="bookmark_add_submit" /></p>
</div>
<div class="bookmarks_list">
	<noscript>
	JavaScript is needed to display your Bookmarks
	</noscript>
	You have no bookmarks
</div>
