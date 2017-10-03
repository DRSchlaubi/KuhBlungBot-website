<?php
    include 'secrets.php';
    $id = $_SESSION['discordid'];

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
    $name = $response['username'];
    $discriminator = $response['discriminator'];
