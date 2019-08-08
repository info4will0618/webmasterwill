<!DOCTYPE HTML>
<html dir='ltr' xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<?php if (empty($title)): $title = "WebMasterWill"; endif; ?>
	<?php if (empty($metaDesc)): $metaDesc = "A very awesome website"; endif; ?>
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $metaDesc; ?>"></meta>
	<meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">
	<link href='<?php echo $cfg['site']['root']; ?>/public/dist/styles.css' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<?php $this->renderSection('head');?>
	<link href='https://fonts.googleapis.com/css?family=Rammetto+One' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Song+Myung" rel="stylesheet">
<!-- 	<link href="https://fonts.googleapis.com/css?family=Wendy+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro" rel="stylesheet"> -->
	<div id="fb-root"></div>
</head>
<body id="body">

	<div id="wrapper_entire-body">
	<!-- Header -->
		
		<?php include(MyHelpers::UrlContent('~/views/shared/_header.php')); ?>

		<?php include(MyHelpers::UrlContent('~/views/shared/components/_social_media.php')); ?>

		<!-- Main -->
		<div id="middle">

			<?php 
			
				$this->renderBody();

			?>

		</div>
		<!-- Footer -->
		<div id="footer">

			<?php include(MyHelpers::UrlContent('~/views/shared/_footer.php')); ?>

		</div>

	<script type="text/javascript" src="<?php echo $cfg['site']['root']; ?>/public/dist/bundle.js"></script>

</body>
</html>