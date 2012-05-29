<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html>
	 <head>
		<link href="<?= base_url() ?>includes/styles/lyrics.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<script language="javascript" type="text/javascript" src="<?= base_url() ?>includes/scripts/jquery-1.2.6.min.js"></script>
		<title><?= $pageTitle ?></title>
	</head>
 
	<body id="home">
	
		<div id="nav">
		 	<?= $content_navigation; ?>
		</div>
		 
		<div id="middle_column">
			<?= $content_body ?>
		</div>
	</body>
 
</html>