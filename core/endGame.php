<?php

function endGame($idStartGame)
{
  
  global $green,$white;
  
  $config = config();
  
  $url = "https://tago.games/prod/api/game/akhir";
  
  $headerRaw = "Host: tago.games
accept-language: in-ID,in;q=0.8
user-agent: {$config['userAgent']}
content-type: application/x-www-form-urlencoded";
  
  $headers = headers($headerRaw);
  
  $body = "access_token={$config['accessToken']}&user_id={$config['userId']}&id={$idStartGame}&contare=".rand(50,100);
  
  $result = requestPost($url,$headers,$body);
  
  $array = json_decode($result,true);
  
  if($array["status"] == "success")
  {
    
    return "{$green}   ~{$white} Reward +{$GLOBALS['yellow']} ".$array["data"]["reward"]." {$green}~\n\n";
  
  }
  else
  {
    
    return userInit();
    
  }
  
}

?>