<head>
    <link rel="icon" type="image/png" href="" sizes="32x32">
    <link href="https://cdn.schlaubi.net/efusiox/style/acp/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://bootswatch.com/lumen/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.mcsn-networks.net/web/jquery.min.js"></script>
    <script src="https://cdn.mcsn-networks.net/web/bootstrap.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <title>KuhBlung - Profile settings</title>
</head>

<?php
session_start();
require_once 'discord.php';
require_once 'mysql_connect.php';
if(isset($_GET['logout'])){
	session_destroy();
	header("Location: index.php?loggedout");
}
if(isset($_GET['unlink'])){
    if($_GET['unlink'] == "netdex"){
       header("Location: unlink.php?unlink=netdex");
    }
    if($_GET['unlink'] == "twitter"){
        header("Location: unlink.php?unlink=twitter");
    }
    if($_GET['unlink'] == "reddit"){
       header("Location: unlink.php?unlink=reddit");
    }
    if($_GET['unlink'] == "steam"){
        header("Location: unlink.php?unlink=steam");
    }
    if($_GET['unlink'] == "twitch"){
       header("Location: unlink.php?unlink=twitch");
    }
}

if(isset($_POST['btn-submit'])){
	$status = $_POST['status']; 
	$discordid = $_SESSION['discordid'];
	mysql_query("UPDATE kuhblung SET status = '$status' WHERE discordid='$discordid'");
	header("Location: ?updated");
}
if($_SESSION['discordid'] == ""){
	header("Location: https://kuhblung.schlb.pw/oauth/callback/discord.php");
	} else { ?>
	 <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">KuhBlung</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Settings</a></li>
                    <li class=""><a href="https://kuhblung.schlb.pw/<?php echo $_SESSION['discordid']; ?>">Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><img height="25" width="25" src="<?php if($avatar == ""){ echo "https://kuhblung.schlb.pw/img/mm.png"; } else { echo $avatarurl;} ?>"   class="img-circle">Hello, <?php echo $name; ?>#<?php echo $discriminator; ?><span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" href="https://discordapp.com/channels/@me">Change avatar</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" href="?logout">Logout</a></li>
                            </ul>
                        </div>
                </ul>
            </div>
        </nav>
        <h2>Social account linking</h2>
	Netdex: 
	<?php if($userRow['netdex'] == "0"){ ?>
			
			<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=netdex','','width=450,height=400')">Click here</a>
	<?php } else { echo $userRow['netdex']; ?>(<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=netdex','','width=450,height=400')">Update</a>|<a href="?unlink=netdex">Unlink</a>)<?php } ?>
	<br>Twitter: 
	<?php if($userRow['twitter'] == "0"){ ?>
			
			<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=twitter','','width=450,height=400')"><img src="https://g.twimg.com/dev/sites/default/files/images_documentation/sign-in-with-twitter-gray.png"></a>
	<?php } else { echo $userRow['twitter']; ?>(<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=twitter','','width=450,height=400')">Update</a>|<a href="?unlink=twitter">Unlink</a>)<?php } ?>
	<br>Reddit:
	<?php if($userRow['reddit'] == "0"){ ?>
			
			<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=reddit','','width=500,height=600')"><i class="fa fa-reddit" arria-hidden="true"></i> Click Here</a>
	<?php } else { echo $userRow['reddit']; ?>(<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=reddit','','width=450,height=400')">Update</a>|<a href="?unlink=reddit">Unlink</a>)<?php } ?>
	<br>Steam:
	<?php if($userRow['steam'] == "0"){ ?>
			
			<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=steam','','width=500,height=600')"><img src="http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png"></a>
	<?php } else { echo $userRow['steam']; ?>(<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=steam','','width=450,height=400')">Update</a>|<a href="?unlink=steam">Unlink</a>)<?php } ?>
	<br>Twitch:
	<?php if($userRow['twitch'] == "0"){ ?>
			
			<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=twitch','','width=500,height=600')"><i class="fa fa-twitch" arria-hidden="true"></i> Click Here</a>
	<?php } else { echo $userRow['twitch']; ?>(<a href="#" onClick="window.open('http://kuhblung.schlb.pw/oauth/request.php?provider=twitch','','width=450,height=400')">Update</a>|<a href="?unlink=twitch">Unlink</a>)<?php } ?>

	<br><h2>Change status:</h2>
	<form method="POST">
		<div class="form-group">
      		<input name="status" type="text" class="form-control" id="status" placeholder="<?php echo $userRow['status']; ?>">
    	</div>
		<button type="submit" class="btn btn-default" name="btn-submit">Submit</button>
	</form>



      
<?php } ?>


