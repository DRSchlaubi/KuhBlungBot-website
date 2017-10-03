

<?php 
	$id = $_GET['id'];
	$url = 'https://discordapp.com/api/v6/users/'.$id;
    include "secrets.php";

	$ch = curl_init();
	curl_setopt_array($ch, array(
	    CURLOPT_URL            => $url,
	    CURLOPT_HTTPHEADER     => array('Authorization: Bot '.$discordtoken),
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_FOLLOWLOCATION => 1,
	    CURLOPT_VERBOSE        => 1,
	    CURLOPT_SSL_VERIFYPEER => 0,
	));
	$json = curl_exec($ch);
	$response = json_decode($json, true);
	$username =  $response['username'];
	$discriminator = $response['discriminator'];
	$avatar = $response['avatar'];
	$avatarurl = "https://cdn.discordapp.com/avatars/$id/$avatar.png";
	curl_close($ch);?>

<html>
<head>
    <!-- Import Google Icon font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <!-- Import materialize.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" media="screen,projection"/>
    <!-- Import Emojis -->
    <link rel="stylesheet" href="css/twemojii-awsome.css"/>
    <!-- Import css.css -->
    <link rel="stylesheet" href="./css/css.css"/>
    <!-- Import font-awesome.css -->
    <link rel="stylesheet" href="css/font-awesome.css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?php if($_GET['id'] != ""){ echo $username; ?>#<?php echo $discriminator;?> - KuhBlung profile<?php } else if(isset($_GET['account']) || isset($_GET['loggedout'])){ ?>KuhBlung account<?php } else {?> KuhBlung<?php } ?></title>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>


<br><br>
<div id="container">
	<style type="text/css">
		.done{
				background-color: #76ff03;
				width: 240px;
				box-shadow: 10px 10px 5px #888888;
				margin-left: auto;
				margin-right: auto;
				text-align: center;

			}
		.center{
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			margin-top: 20%;
		}
	</style>
	<?php 
	require_once 'mysql_connect.php';
	if(isset($_GET['loggedout'])){?>
		<br><h2>KuhBlung account </h2>
		<br><div class="done"><i class="fa fa-check-square" aria-hidden="true"></i>Succesfully logged out</div>
		<div class="center">
			<a class="waves-effect waves-light btn" href="account.php">Login through Discord</a>
		</div>
	</div>
		<?php
		return;
	} ?>
	<?php if(isset($_GET['account'])){?>
		<br><h2>KuhBlung account </h2>
		<div class="center">
			<a class="waves-effect waves-light btn" href="account.php">Login through Discord</a>
		</div>
	</div>
		<?php
		return;
	} ?>
	 <?php
	$id = $_GET['id'];

	if($id == ""){?>
		<br><br>
		<img class="circle" src="https://cdn.discordapp.com/avatars/357534677013364747/1c5d88caf8e64d4cc9ed13b02742636b.png">
		<h4>KuhBlung bot</h4>
		<br>
		<a href="http://d.schlb.pw">Join my Discord</a><br>
		<a href="?account">Account login</a><br>
		<a href="https://github.com/DRSchlaubi/KuhBlungBot">Github</a>
		<?php return;
	}

	
	$res = mysql_query("SELECT * FROM kuhblung WHERE discordid='$id'");
	$user = mysql_fetch_array($res);
	if(mysql_num_rows($res) == 0){
		echo "404";
		return;
	}

	?>
    <h4 id="heading"><?php echo $username; ?>#<?php echo $discriminator; ?></h4>
    <img class="circle" src="<?php echo $avatarurl; ?>">
    <h6 id="heading">KuhBlung profile</h6>
    <div class="row item">
        <div class="col s4">
            <i class="twa twa-moneybag"></i>Money: <?php echo $user['money']; ?> $
        </div>
        <div class="col s8">
            <i class="twa twa-cookie"></i>Cookies: <?php echo $user['cookies']; ?>
        </div>
    </div>
    <div class="row item">
        <div class="col s4">
            <i class="twa twa-small-blue-diamond"></i>Points: <?php echo $user['points']; ?>
        </div>
        <div class="col s8">
            <i class="twa twa-large-blue-diamond"></i>Level: <?php echo $user['level']; ?>
        </div>
    </div>
    <div class="row item">
        <i class="twa twa-pager"></i>Status: <?php echo $user['status']; ?>
    </div>
    <h4>Social accounts</h4>
    <div class="row">
    	<div class="col s4">	
    		<?php if($userRow['netdex'] != "0") { ?><img src="https://netdex.co/img/icons/64.png" height="16" width="16">Netdex: <a href="http://netdex.co/<?php echo $userRow['nedtdex']; ?>"><?php echo $userRow['netdex']; ?></a><?php } ?>
        	</div>
        <div class="col s8">
            <?php if($userRow['twitter'] != "0") { ?><img src="https://kuhblung.schlb.pw/img/TwitterLogo.png" height="16" width="16">Twitter: <a href="http://twitter.com/<?php echo $userRow['twitter']; ?>"><?php echo $userRow['twitter']; ?></a><?php } ?>  
    	</div>
    </div>
    <div class="row">
        	<div class="col s4">
        		<?php if($userRow['reddit'] != "0") { ?><img src="https://kuhblung.schlb.pw/img/RedditLogo.png" height="16" width="16">Reddit: <a href="http://reddit.com/u/<?php echo $userRow['reddit']; ?>"><?php echo $userRow['reddit']; ?></a><?php } ?>  
        	</div>
        	<div class="col s8">
        		<?php if($userRow['steam'] != "0") { ?><img src="https://kuhblung.schlb.pw/img/SteamLogo.png" height="16" width="16">Steam: <a href="<?php echo $userRow['steam']; ?>"><?php echo $userRow['steam']; ?></a><?php } ?>  
        	</div>
        </div>
		<div class="row">
				<center><?php if($userRow['twitch'] != "0") { ?><img src="https://kuhblung.schlb.pw/img/TwitchLogo.png" height="16" width="16">Twitch: <a href="http://twitch.tv/<?php echo $userRow['twitch']; ?>"><?php echo $userRow['twitch']; ?></a><?php } ?></center>
		</div>
    </div>
	




</div>
</body>
</html>





