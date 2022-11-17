<?php
	session_start();
	require("urlShortener.php");
	$app = new urlShortener();

	echo $app->getAllURLSFromIP(true);
?>