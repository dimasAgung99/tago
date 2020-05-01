<?php

function config()
{
  
  require __DIR__.'/../config.php';

  $config = [];
  $config["accessToken"] = $accessToken;
  $config["userId"] = $userId;
  $config["aid"] = $aid;
  $config["token"] = $token;
  $config['userAgent'] = $userAgent;
  
  return $config;
  
}


?>