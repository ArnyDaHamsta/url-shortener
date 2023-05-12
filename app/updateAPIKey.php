<?php
	session_start();
	require("urlShortener.php");
	$app = new urlShortener();
    $curUser = $app->getCurrentUser();
    if($curUser == "0"){
        echo "token_0";
    } else {
        echo $app->updateUserAPIKey($app->getCurrentUser());
    }
?>