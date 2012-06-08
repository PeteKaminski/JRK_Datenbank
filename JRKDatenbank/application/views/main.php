<?php $this->load->helper('url'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<!-- Mybe css File Import -->
		<title><?= $pageTitle ?></title>
		<link type="text/css" href="<?php echo base_url() ?>/css/header.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url() ?>/css/navi.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url()."/css/content.css" ?>" rel="stylesheet" />
		<!--<script language="javascript" type="text/javascript" src="<?= base_url() ?>includes/scripts/jquery-1.2.6.min.js"></script> -->
	</head>
	<body>
		<div id="header">
			<?= $header ?>
		</div>
		<div id="navi">
			<?= $navigation ?>
		</div>
		<div id="content">
			<?= $content ?>
		</div>
		
	</body>
 
</html>