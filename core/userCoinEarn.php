<?php


function userCoinEarn()
{
  
  global $white,$green,$yellow;
  
  $config = config();
  
  $url = [];
  
  $url[0] = "https://tago.games/prod/api/user/coin_earn";
  
  $url[1] = "https://tago.games/prod/api/user/rewNew";
  
  $body = [];
  
  $body[0] = "access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $body[1] = $body[0]."&type=X2_TAGO";
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Content-Type: application/x-www-form-urlencoded
Host: tago.games
Connection: Keep-Alive";
  
  $headers = headers($headerRaw);
  
  $kondisi = true;
  
  while($kondisi)
  {
  
    for ($i = 0; $i <= 1; $i++) 
    {
       // code...
    
      $result = requestPost($url[$i],$headers,$body[$i]);
      
      $resultArray = json_decode($result,true);
      
      if($resultArray["status"] == "success")
      {
      	
      	if($i == 0)
      	{
      	  
      	  echo "{$green}• {$white}collect tago bonus ->{$green} ".$resultArray["status"]."\n";
      	  
      	}
      	else 
      	{
      	  
      	  echo "{$green}• {$white}collect tago bonus x2 ->{$green} ".$resultArray["status"]."\n";
      	  
      	}
      	
      	  
      }
      else
      {
         
         echo "{$white}•{$yellow} ".$resultArray["message"]."\n";
         $kondisi = false;
         break;
         
      }
      
      
      sleep(5);
    
  
    }
    
    sleep(1);
  
  }
  
}

?>