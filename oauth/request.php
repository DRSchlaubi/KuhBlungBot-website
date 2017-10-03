
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google" content="notranslate" />
    <meta name="robots" content="noindex,nofollow,noodp" />
    <link rel="stylesheet" href="../css/font-awesome.css">
    <?php switch($_GET['provider']){
	case "netdex":
	?><meta http-equiv="refresh" content="2; URL=https://kuhblung.schlb.pw/oauth/callback/netdex.php"><?php
	break;
	case "twitter":
	?><meta http-equiv="refresh" content="2; URL=https://kuhblung.schlb.pw/oauth/callback/twitter.php"><?php
	break;
	case "reddit":
	?><meta http-equiv="refresh" content="2; URL=https://kuhblung.schlb.pw/oauth/callback/reddit.php"><?php
	break;
	case "steam":
	?><meta http-equiv="refresh" content="2; URL=https://kuhblung.schlb.pw/oauth/callback/steam.php"><?php
	break;
	case "twitch":
	?><meta http-equiv="refresh" content="2; URL=https://kuhblung.schlb.pw/oauth/callback/twitch.php"><?php
	break;
	}?>
    
    <link type="text/css" rel="stylesheet" href="../../css/social.css" />
    <title></title>
</head>
<body>
<div class="social-icon-wrp redirecting">

  <?php switch($_GET['provider']){
	case "netdex":
	?><div class="social-icon pixel">N</div>
<?php
	break;
	case "twitter":
	?><div class="social-icon"><i class="icon-twitter"></i></div><?php
	break;
	case "reddit":
	?><div class="social-icon"><i class="fa fa-reddit" aria-hidden="true"></i></div><?php
	break;
	case "steam":
	?><div class="social-icon"><i class="fa fa-steam" aria-hidden="true"></i></div><?php
	break;
	case "twitch":
	?><div class="social-icon"><i class="fa fa-twitch" aria-hidden="true"></i></div><?php
	}?>
    
</div>



</body>
</html>