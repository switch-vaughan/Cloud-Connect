<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $title ?></title>
	<link href="<?php echo $url ?>src/css/default.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $url ?>src/css/admin/screen.css" media="screen" rel="stylesheet" type="text/css"/>
	<script src="<?php echo $url ?>src/js/jquery-1.6.1.min.js" type="text/javascript"></script>
	<script src="<?php echo $url ?>src/js/admin/init.js" type="text/javascript"></script>
	<script src="<?php echo $url ?>src/js/admin/hints.js" type="text/javascript"></script>
	<script src="<?php echo $url ?>src/js/admin/article.js" type="text/javascript"></script>
</head>
<body>
	<div id="core-wrapper">
		<?php echo isset($header) ? $header : '' ?>
		<?php echo isset($menu) ? $menu : '' ?>
		<div id="content-wrapper">
			<noscript>
				<p>This CMS makes use of Javascript and we have detected that your Javascript is disabled.</p>
			</noscript>
			<?php echo isset($content) ? $content : '' ?>
		</div>
		<br class="clear"/>
	</div>
</body>
</html>