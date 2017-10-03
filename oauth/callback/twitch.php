<script type="text/javascript">
    function closePopup() {
        setTimeout( function() {
            window.opener.location.reload();
            open(location, '_self').close();
        }, 2000);
    }

    <?php if(isset($_GET['finish'])){ ?> closePopup(); <?php return; }?>

</script>

<?php setcookie("return_url", $_SERVER["REQUEST_URI"], time() + 60000, '/');
include 'libs/twitch/twitchtv.php'; 
include_once '../../mysql_connect.php';
$twitchtv = new TwitchTv; 
if (!isset($_COOKIE["access_token"])) {
   
    $ttv_code = $_GET['code'];
    $access_token = $twitchtv->get_access_token($ttv_code);
} else {
    $access_token = $_COOKIE["access_token"];
}
$user_name = $twitchtv->authenticated_user($access_token);

if (isset($user_name)) {
    // reset the cookies for other all of the other examples.
    unset($_COOKIE['return_url']);
    setcookie('return_url', '', time() - 1, '/');
    unset($_COOKIE['access_token']);
// empty value and expiration one hour before
    setcookie('access_token', '', time() - 1);
    $discordid = $userRow['discordid'];
    mysql_query("UPDATE kuhblung SET twitch='$user_name' WHERE discordid='$discordid'");
    echo '<script type="text/javascript">closePopup();</script>';

} else {
	 header('Location: ' . $twitchtv->authenticate() );
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
    <link rel="stylesheet" href="../../css/font-awesome.css">
    <title></title>
</head>
<body>
<div class="social-icon-wrp redirecting">
    <div class="social-icon pixel">
        <i class="fa fa-twitch" aria-hidden="true"></i>
    </div>
</div>



</body>
</html>
