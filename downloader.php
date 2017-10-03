<?php if(isset($_GET['notfound'])) { ?>

<!DOCTYPE html>
<html lang=en>
<meta charset=utf-8>
<meta name=viewport content="initial-scale=1, minimum-scale=1, width=device-width">
<title>Error 404 (Not Found)!!1</title>
<style>
    *{margin:0;padding:0}html,code{font:15px/22px arial,sans-serif}html{background:#fff;color:#222;padding:15px}body{margin:7% auto 0;max-width:390px;min-height:180px;padding:30px 0 15px}* > body{background:url(//www.google.com/images/errors/robot.png) 100% 5px no-repeat;padding-right:205px}p{margin:11px 0 22px;overflow:hidden}ins{color:#777;text-decoration:none}a img{border:0}@media screen and (max-width:772px){body{background:none;margin-top:0;max-width:none;padding-right:0}}#logo{background:url(//www.google.com/images/branding/googlelogo/1x/googlelogo_color_150x54dp.png) no-repeat;margin-left:-5px}@media only screen and (min-resolution:192dpi){#logo{background:url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) no-repeat 0% 0%/100% 100%;-moz-border-image:url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) 0}}@media only screen and (-webkit-min-device-pixel-ratio:2){#logo{background:url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) no-repeat;-webkit-background-size:100% 100%}}#logo{display:inline-block;height:54px;width:150px}
</style>
<a href=//www.google.com/><span id=logo aria-label=Google></span></a>
<p><b>404.</b> <ins>That’s an error.</ins>
<p>The requested avatar was not found on this server.  <ins>That’s all we know.</ins>
<?php  return; } ?>

<?php

include "secrets.php";
if(isset($_POST['btn-submit'])){
    $id = $_POST['id'];

    $url = 'https://discordapp.com/api/v6/users/'.$id;


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
    $avatar = $response['avatar'];
    $avatarurl = "https://cdn.discordapp.com/avatars/$id/$avatar.png";
    if($avatar == ""){
        header("Location: index.php?notfound");
        return;
    }
    header("Location: $avatarurl");
    curl_close($ch);
}
?>



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
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Discord avatar downloader</title>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>



<div id="container">
    <h2 id="heading">Discord avatar downloader</h2>
    <div class="row item">
        <form method="POST">
            <div class="input-field col s6">
                <input id="id" type="number" minlength="16" maxlength="16" class="validate" name="id" required>
                <label for="id">Discord id</label>
            </div>
            <div class="input-field col s6">
                <button type="submit" name="btn-submit" class="btn waves-effect waves-light">Submit</button>
            </div>
        </form>
    </div>




</div>
</body>
</html>





