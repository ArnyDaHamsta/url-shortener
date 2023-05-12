<?php
	require __DIR__ . '/vendor/autoload.php';
	$router = new \Bramus\Router\Router();

	require("app/urlShortener.php");

	$router->get('/', function() {
		include("app/app.php");
	});

	$router->get('/login', function() {
		include("app/login.php");
	});

	$router->get('/keycloak', function() {
		include("app/keycloakLogin.php");
	});

	$router->get('/account', function() {
		include("app/account.php");
	});

	$router->get('/logout', function() {
		session_start();
		$_SESSION = array();
		session_destroy();
		include("app/logout.php");
	});

	$router->get('/go', function() {
		header("Location: https://l.deko.moe");
	});

	$router->get('/view', function() {
		header("Location: https://l.deko.moe");
	});

	$router->get('/go/{id}', function($id) {
		include("app/redirect.php");
	});

	$router->get('/view/{id}', function($id) {
		include("app/view.php");
	});

	$router->run();
?>