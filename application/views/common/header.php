<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php echo html_escape($title); ?></title>

	<?php echo link_tag('assets/css/global.css'); ?>
	<?php echo link_tag('assets/css/font-awesome.css'); ?>

	<script src="<?php echo base_url('assets/js/global.js'); ?>" type="text/javascript"></script>
</head>

<body class="<?php echo html_escape($bodyclass); ?>">
<div id="content">

<h1><?php echo html_escape($title); ?></h1>

