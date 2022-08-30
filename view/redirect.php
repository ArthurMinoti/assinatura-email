<?php
	require_once '../vendor/autoload.php';

	session_start();

	$client = new Google\Client();
	$client -> setAuthConfig('..controller/client_secrets.json');
	$client -> setRedirectUri('https://' . $_SERVER['HTTP_HOST'] . '/redirect.php');

	$client = new Google\Client();

	if (! isset($_GET['code'])) {
		$auth_url = $client->createAuthUrl();
		header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	} else {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client -> getAccessToken();
		echo $client ->getClientId();
	}


