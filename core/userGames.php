<?php

function userGames()
{
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/games?access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Host: tago.games
Connection: Keep-Alive";

  $headers = headers($headerRaw);
  
  $result = requestGet($url,$headers);
  
  //print_r($result);exit();
  
  $array = json_decode($result,true);
  
  if($array["status"] == "success")
  {
    
    $dataLength = count ($array["data"]);
    
    $randomId = rand(0,$dataLength);
    //return $array["data"][0];
    return $array["data"][$randomId];
    
  }
  
}

?>