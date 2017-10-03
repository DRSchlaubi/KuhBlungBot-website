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
require_once ("../../mysql_connect.php");
require '../../secrets.php';
if (isset($_GET["error"]))
{
    echo("<pre>OAuth Error: " . $_GET["error"]."\n");
    echo('<a href="index.php">Retry</a></pre>');
    die;
}

$authorizeUrl = 'https://ssl.reddit.com/api/v1/authorize';
$accessTokenUrl = 'https://ssl.reddit.com/api/v1/access_token';
$clientId = $redditClientId;
$clientSecret = $redditClientSecret;
$userAgent = 'KuhBlung/0.1 by Schlaubi';

$redirectUrl = "https://kuhblung.schlb.pw/oauth/callback/reddit.php";

require("libs/phpoauth2/Client.php");
require("libs/phpoauth2/GrantType/IGrantType.php");
require("libs/phpoauth2/GrantType/AuthorizationCode.php");

$client = new OAuth2\Client($clientId, $clientSecret, OAuth2\Client::AUTH_TYPE_AUTHORIZATION_BASIC);
$client->setCurlOption(CURLOPT_USERAGENT,$userAgent);

if (!isset($_GET["code"]))
{
    $authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl, array("scope" => "identity", "state" => "SomeUnguessableValue"));
    header("Location: ".$authUrl);
    die("Redirect");
}
else
{
    $params = array("code" => $_GET["code"], "redirect_uri" => $redirectUrl);
    $response = $client->getAccessToken($accessTokenUrl, "authorization_code", $params);

    $accessTokenResult = $response["result"];
    $client->setAccessToken($accessTokenResult["access_token"]);
    $client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

    $response = $client->fetch("https://oauth.reddit.com/api/v1/me.json");
    $discordid = $userRow['discordid'];
    $info = $response['result'];
    $username = $info['name'];

    mysql_query("UPDATE kuhblung SET reddit='$username' WHERE discordid='$discordid'");
	echo '<script type="text/javascript">closePopup();</script>';
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
        <i class="fa fa-reddit" aria-hidden="true"></i>
    </div>
</div>



</body>
</html>
