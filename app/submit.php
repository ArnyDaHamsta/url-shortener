<?php
	require("urlShortener.php");
	require("locale.php");
	$app = new urlShortener();
	if(isset($_POST)){
		if(!isset($_POST["urlInput"])){
			$_POST = json_decode(file_get_contents("php://input"), true);
			$url = $_POST["urlInput"];
			$safe = $_POST["safetyPage"];
		} else {
			$url = $_POST["urlInput"];
			$safe = $_POST["safetyPage"];
		}
		if($url == ""){
			echo $app->generateResponse("error", $translator->translate('noURL'));
			return;
		}

		$code = $app->addUrl($url, $safe);
		if($code && !is_array($code)){
			echo $app->generateResponse("code", $code);
		} elseif(is_array($code)){
			echo $app->generateResponse($code[0], $code[1]);
		} else {
			echo $app->generateResponse("error", $translator->translate('couldnotShorten'));
		}
	}
?>