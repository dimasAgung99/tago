<?php

function userInit()
{
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/init?access_token={$config['accessToken']}&user_id={$config['userId']}&aid={$config['aid']}&token=".$config['token'];
  
  $headerRaw = "Host: tago.games
accept-language: in-ID,in;q=0.8
user-agent: {$config['userAgent']}
authorization: Basic dGFnb19pY2FuOkQnMyouQC00SG5yQEx7fi8=";

  $headers = headers($headerRaw);
  $result = requestGet($url,$headers);
  $array = json_decode($result,true);
  
  if($array["status"] != "success")
  {
    
    die('kesalahan');
    
  }
  
}


?>