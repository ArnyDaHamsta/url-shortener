<?php
	require("urlShortener.php");
	$app = new urlShortener();

	echo $app->getAllURLSFromIP();
?>