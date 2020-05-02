<?php

function userDashboard()
{
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/dashboard?access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Host: tago.games
accept-language: in-ID,in;q=0.8
user-agent: {$config['userAgent']}";
  $headers = headers($headerRaw);
  $result = requestGet($url,$headers);
  $array = json_decode($result,true);
  echo "• location : ".$array['data']['user']['location']."\n\n";
  
}

?>
