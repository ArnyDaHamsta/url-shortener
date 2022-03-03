<?php
	require __DIR__ . '/vendor/autoload.php';
	$router = new \Bramus\Router\Router();

	require("app/urlShortener.php");

	$router->get('/', function() {
		include("app/app.php");
	});

	$router->get('/go', function() {
		header("Location: https://l.deko.moe");
	});

	$router->get('/go/{id}', function($id) {
		include("app/redirect.php");
	});

	$router->run();
?>