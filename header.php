<?php
session_start();

if (!isset($_SESSION['style']))
	$_SESSION['style'] = 'style1';

if (isset($_POST['style'])) {
	if ($_POST['style'] == 'style1')
		$_SESSION['style'] = 'style1';
	if ($_POST['style'] == 'style2')
		$_SESSION['style'] = 'style2';
}

if(isset($_GET["cookieLover"])) {
	setcookie("cookieLover", "true");
	$_COOKIE["cookieLover"]="true";
}

include("model.php");
?>

<!doctype html>
<html>
	<head>
	<title>Mon doodle à moi</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="<?php if ($_SESSION['style'] == 'style1') echo 'clair.css'; if ($_SESSION['style'] == 'style2') echo 'sombre.css'; ?>">
	</head>
	<body>
