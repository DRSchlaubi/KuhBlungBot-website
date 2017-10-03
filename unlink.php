<?php
include "mysql_connect.php";
if($_GET['unlink'] == "netdex"){
        $discordid = $userRow['discordid'];
        mysql_query("UPDATE kuhblung SET netdex = '0' WHERE discordid='$discordid'");
	header("Location: account.php?unlinked=netdex");
    }
    if($_GET['unlink'] == "twitter"){
        $discordid = $userRow['discordid'];
        mysql_query("UPDATE kuhblung SET twitter  = '0' WHERE discordid='$discordid'");
	header("Location: account.php?unlinked=twitter");
    }
    if($_GET['unlink'] == "reddit"){
        $discordid = $userRow['discordid'];
        mysql_query("UPDATE kuhblung SET reddit   = '0' WHERE discordid='$discordid'");
	header("Location: account.php?unlinked=reddit");
    }
    if($_GET['unlink'] == "steam"){
        $discordid = $userRow['discordid'];
        mysql_query("UPDATE kuhblung SET steam = '0' WHERE discordid='$discordid'");
	header("Location: account.php?unlinked=steam");
    }
    if($_GET['unlink'] == "twitch"){
        $discordid = $userRow['discordid'];
        mysql_query("UPDATE kuhblung SET twitch  = '0' WHERE discordid='$discordid'");
	header("Location: account.php?unlinked=twitch");
    }
