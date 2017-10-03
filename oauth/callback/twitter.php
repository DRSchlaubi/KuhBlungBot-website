
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google" content="notranslate" />
    <meta name="robots" content="noindex,nofollow,noodp" />
    <link type="text/css" rel="stylesheet" href="../../css/social.css" />
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
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
    <div class="social-icon pixel">
        <i class="icon-twitter"></i>
    </div>
</div>



</body>
</html>
<?php



// Load the library files
require_once('libs/twitter/OAuth.php');
require_once('libs/twitter/twitteroauth.php');
require_once ('../../mysql_connect.php');
// define the consumer key and secet and callback
require '../../secrets.php';




if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
	// create a new twitter connection object
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	// get the token from connection object
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK); 
	// if request_token exists then get the token and secret and store in the session
	if($request_token){
		$token = $request_token['oauth_token'];
		setcookie("request_token",$token,0); 
		setcookie("request_token_secret",$request_token['oauth_token_secret'],0); 
		// get the login url from getauthorizeurl method
		$login_url = $connection->getAuthorizeURL($token);
	}
	header("Location: $login_url");
}


// 3. if its a callback url
if(isset($_GET['oauth_token'])){
	
	// create a new twitter connection object with request token
	$con1 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_GET['oauth_token'], $_GET['oauth_verifier']);
	// get the access token from getAccesToken method
	$access_token = $con1->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token){

		// create another connection object with access token
		$con = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		// set the parameters array with attributes include_entities false
		$params =array('include_entities'=>'false');
		// get the data
		$data = $con->get('account/verify_credentials',$params);
		if($data){ 
			$username = $data->screen_name;
			$discordid = $userRow['discordid'];
			mysql_query("UPDATE kuhblung SET twitter='$username' WHERE discordid='$discordid'");
			echo '<script type="text/javascript">closePopup();</script>';
		}
		
	}
}

?>


