<!DOCTYPE html>
<html>
	<head>
		<title>ownCloud</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="<?php echo image_path('', 'favicon.png'); ?>" /><link rel="apple-touch-icon-precomposed" href="<?php echo image_path('', 'favicon-touch.png'); ?>" />
		<?php if(isset($_['cssfiles'])) foreach($_['cssfiles'] as $cssfile): ?>
			<link rel="stylesheet" href="<?php echo $cssfile; ?>" type="text/css" media="screen" />
		<?php endforeach; ?>
		<script type="text/javascript">
			var oc_webroot = '<?php global $WEBROOT; echo $WEBROOT; ?>';
		// </script>
		<?php if(isset($_['jsfiles'])) foreach($_['jsfiles'] as $jsfile): ?>
			<script type="text/javascript" src="<?php echo $jsfile; ?>"></script>
		<?php endforeach; ?>
	
		<?php foreach($_['headers'] as $header): ?>
			<?php
				echo '<'.$header['tag'].' ';
				foreach($header['attributes'] as $name=>$value){
					echo "$name='$value' ";
				};
				echo '>';
				echo $header['text'];
				echo '</'.$header['tag'].'>';
			?>
			<script type="text/javascript" src="<?php echo $jsfile; ?>"></script>
		<?php endforeach; ?>
	</head>

	<body id="body-login">
		<div id="login">
			<header><div id="header">
				<img src="<?php echo image_path('', 'owncloud-logo-medium-white.png'); ?>" alt="ownCloud" />
			</div></header>
			<?php echo $_['content']; ?>
		</div>
		<footer><p class="info"><a href="http://owncloud.org/">ownCloud</a> <?php echo $l->t( 'is a personal cloud which runs on your own server' ); ?>.</p></footer>
	</body>
</html>
