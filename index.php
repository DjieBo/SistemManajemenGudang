<?php
	include 'config/config.php';
	include 'config/system.php';
	include 'config/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Warehouse Gate In System</title>
	<link href="css/style.css" rel="stylesheet">
	<script src="js/onchange.js"></script>
	<style type="text/css">
		@font-face {
		   font-family: Roboto;
		   src: url(Roboto-Regular.ttf);
		}
		body{font-family: Roboto;}
	</style>
</head>
<body>
<?php
	session_start();
	error_reporting(0);
	if($_SESSION['status'] == 'gatein'){gatein();}
	elseif($_SESSION['status'] == 'gateout'){gateout();}
	elseif($_SESSION['status'] == 'inquerysales'){inquerySales();}
	elseif($_SESSION['status'] == 'report'){report();}
	elseif($_GET['sys'] == 'admin'){reg();}
	else{defaultView();}
?>
</body>
</html>