<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Camping Facile</title>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/sb-admin.css" rel="stylesheet">
		<!-- Morris Charts CSS -->
		<link href="css/plugins/morris.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
		<script src="js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Morris Charts JavaScript -->
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/formPictures.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="menu_nav">
				<div class="navbar-header"><a class="navbar-brand" href="index.php">Camping Facile : Le projet turfu </a></div>
				<ul class="nav navbar-right top-nav"></ul>
				<?php 
					if (auth()) require ("./includes/view/menu.php");
				?>
			</nav>
			<div id="page-wrapper">
				<div class="container-fluid">
					<div id="mainAjax" name="mainAjax">
					<?php
						require ("./includes/view/home.php");
					?>
					</div>
				</div>
			</div>
		</div>
	</body>
	<link href="css/jquery.datetimepicker.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.datetimepicker.full.min.js"></script>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("a[class!='ajaxed']").click(function(){
			loadToMain($(this).attr("href"), "{}"); return false;
		});
	//$("a[class!='ajaxed']").attr('href', '');
	$("a[class!='ajaxed']").addClass('ajaxed');
	$.datetimepicker.setLocale('fr');
});
</script>