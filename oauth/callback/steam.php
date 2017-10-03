
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google" content="notranslate" />
    <meta name="robots" content="noindex,nofollow,noodp" />
    <link type="text/css" rel="stylesheet" href="../../css/social.css" />
    <link rel="stylesheet" href="../../css/font-awesome.css">
    <title>KuhBlung - Social account linking</title>
</head>
<body>
<script type="text/javascript">
    function closePopup() {
        setTimeout( function() {
            window.opener.location.reload();
            open(location, '_self').close();
        }, 2000);
    }

    <?php if(isset($_GET['finish'])){ ?> closePopup(); <?php return; }?>

</script>
<div class="social-icon-wrp redirecting">
    <div class="social-icon">
	<i class="fa fa-steam" aria-hidden="true"></i>
    </div>
</div>



</body>
</html>
<?php
require 'libs/steam/openid.php';
require_once '../../mysql_connect.php';
require '../../secrets.php';
try 
{
    $openid = new LightOpenID('https://kuhblung.schlb.pw/oauth/callback/steam.php');
    if(!$openid->mode) 
    {
        
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
        
?>
<form action="?login" method="post">
    <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png">
</form>
<?php
    } 
    elseif($openid->mode == 'cancel') 
    {
        echo 'User has canceled authentication!';
    } 
    else 
    {
        if($openid->validate()) 
        {
                $id = $openid->identity;
                // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                // we only care about the unique account ID at the end of the URL.
                $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                preg_match($ptn, $id, $matches);

                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
                $json_object= file_get_contents($url);
                $json_decoded = json_decode($json_object);

                foreach ($json_decoded->response->players as $player)
                {
                    
                    $username = $player->profileurl;
					$discordid = $userRow['discordid'];
					mysql_query("UPDATE kuhblung SET steam='$username' WHERE discordid='$discordid'");
					echo '<script type="text/javascript">closePopup();</script>';
                }

        } 
        else 
        {
                echo "User is not logged in.\n";
        }
    }
} 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}
?>