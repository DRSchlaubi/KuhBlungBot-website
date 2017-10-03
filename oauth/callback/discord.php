<?php


session_start();
require_once '../../mysql_connect.php';
require 'libs/discord/vendor/autoload.php';
require '../../secrets.php';

if (! isset($_GET['code'])) {
	header('Location: '.$provider->getAuthorizationUrl());
} else {
	$token = $provider->getAccessToken('authorization_code', [
		'code' => $_GET['code'],
	]);

	// Get the user object.
	$user = $provider->getResourceOwner($token);

	
	$_SESSION['discordid'] = $user->id;
	$discordid = $_SESSION['discordid'];
	$sql = mysql_query("SELECT * FROM kuhblung WHERE discordid='$discordid");
	if(mysql_num_rows($sql) == 0){
		$sql = "INSERT INTO `kuhblung`(`id`, `discordid`, `level`, `points`, `money`, `cookies`, `status`,`netdex`,`twitter`,`reddit`,`steam`,`twitch`) VALUES ('', '$discordid', '1', '0', '0', '0', 'Hey, I am using Discord','0','0','0','0','0')";
		mysql_query($sql);
	}
	header("Location: https://kuhblung.schlb.pw/account.php");
	}
	



