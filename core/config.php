<?php

function config()
{
  
  $file = __DIR__."/../config.json";
  if(filesize($file) === 0)
  {
    
    die("\n".'config kosong! silahkan edit config!');
    
  }
  else 
  {
    
    $json = file_get_contents($file);
    $config = json_decode($json,true);
    return $config;
    
  }
    
}

/*
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
*/

?>