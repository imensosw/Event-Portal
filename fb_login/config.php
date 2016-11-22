<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '266255650409144'; //Facebook App ID
$appSecret = '9fb53cf872e7719caf476bd5899be136'; // Facebook App Secret
$homeurl = 'http://zuruuna.com/beta/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>