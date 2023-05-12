<?php
	session_start();
	require("urlShortener.php");
	require("locale.php");
	$app = new urlShortener();
	if(isset($_POST)){
		if(!isset($_POST["urlInput"])){
			$_POST = json_decode(file_get_contents("php://input"), true);
			$url = $_POST["urlInput"];
			$safe = $_POST["safetyPage"];
			$customURL = $_POST["customURLInput"];
		} else {
			$url = $_POST["urlInput"];
			$safe = $_POST["safetyPage"];
			$customURL = $_POST["customURLInput"];
		}
		if($url == ""){
			echo $app->generateResponse("error", $translator->translate('noURL'));
			return;
		}
		if($customURL == ""){
			$customURL = false;
		}
		if(isset($_POST["apiKey"])){
			$apiKey = $_POST["apiKey"];
			$user = $app->getUserFromAPIKey($apiKey);
		} else {
			$user = "0";
		}


		$code = $app->addUrl($url, $safe, $customURL, $user);
		if($code && !is_array($code)){
			echo $app->generateResponse("code", $code);
		} elseif(is_array($code)){
			echo $app->generateResponse($code[0], $code[1]);
		} else {
			echo $app->generateResponse("error", $translator->translate('couldnotShorten'));
		}
	}
?>