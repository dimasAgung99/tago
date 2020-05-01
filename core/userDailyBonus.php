<?php

function userDailyBonus()
{
  global $green,$white,$yellow;
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/daily_bonus";
  
  $body = "access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Content-Type: application/x-www-form-urlencoded
Host: tago.games
Connection: Keep-Alive";

  $headers = headers($headerRaw);
  
  $result = requestPost($url,$headers,$body);
  
  $array = json_decode($result,true);
  
  if($array['status'] == 'fail')
  {
    
    extract($array['data']);
    
    if($day == "8")
    {
      
      $day = 1;
      
      
    }
    
    
    echo "{$green}•{$white} Daily Bonus ~{$green} Day ".$day."{$white} ->{$yellow} Besok\n\n";
    
  }
  else 
  {
    
    extract($array['data']);
    
    echo "{$green}•{$white} Daily Bonus ~{$yellow} Day ".$day."{$white} ->{$green} ".$array['message']."\n\n";
    
  }
  
}

?>