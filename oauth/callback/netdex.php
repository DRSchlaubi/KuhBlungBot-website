<script type="text/javascript">
    function closePopup() {
        setTimeout( function() {
            window.opener.location.reload();
            open(location, '_self').close();
        }, 2000);
    }

    <?php if(isset($_GET['finish'])){ ?> closePopup(); <?php return; }?>

</script>


<?php
/**
 * callback_granted.php
 *
 *
 * Netdex api callback for KuhBlung Discord bot
 *
 * @link https://kuhblung.schlb.pw
 * @version 1.0
 * @author Michael "Schlaubi" Rittmeister
 * @copyright Copyright (c) 2017, Schlaubi
 */

require_once "libs/netdex/Netdex.class.php";
require_once "../../mysql_connect.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Ask if data was sent
if(!empty($_POST["app_user_id"])&&!empty($_POST["app_user_key"])&&!isset($_GET['finish']))
{
    // Let's create a Netdex instance - https://api.netdex.co/docs/usage.md
    $netdex=new Netdex($app_id,$app_key);
    // Verify request data was signed by Netdex
    if($netdex->verifyPOST())
    {
        // Get the user ID and key
        $id=$_POST["app_user_id"];
        $key=$_POST["app_user_key"];
        // Add verified user data to instance - https://api.netdex.co/docs/usage.md
        $netdex->setUser($id,$key);
        // And request some user information - https://api.netdex.co/docs/user.md
	$user = $netdex->request("user",["i"]);
        $username=$netdex->request("user", [$user["name"]])["name"];
        // Now we output $user_info, but we can also use it to store the user in a database. - Don't forget to store the user id and key to
        $discordid = $userRow['discordid'];
	mysql_query("UPDATE kuhblung SET netdex='$username' WHERE discordid='$discordid'");
	echo '<script type="text/javascript">closePopup();</script>';
    } else
    {
        // Sent data is not signed with our verification key
        header("Location: https://netdex.co/apps/auth#".$app_id);
    }
} else
{
    // No data was sent
    header("Location: https://netdex.co/apps/auth#".$app_id);
}
?>


<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google" content="notranslate" />
    <meta name="robots" content="noindex,nofollow,noodp" />
    <link type="text/css" rel="stylesheet" href="../../css/social.css" />
    <title></title>
</head>
<body>

<div class="social-icon-wrp redirecting">
    <div class="social-icon pixel">
        N
    </div>
</div>



</body>
</html>

