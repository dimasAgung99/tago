<?php

function startGame()
{
  
  global $green,$white;
  
  $config = config();
  
  echo "\n\n";
  
  $i = 1;
  
  while(true)
  {
  
    $userGames = userGames();
    $gameId = $userGames["id"];
    $nameGame = $userGames["name"];
    $minTime = $userGames["minTime"];
    $url = "https://tago.games/prod/api/game/mulai";
  
    $headerRaw = "Host: tago.games
accept-language: in-ID,in;q=0.8
user-agent: {$config['userAgent']}
content-type: application/x-www-form-urlencoded
accept: */*";
  
    $headers = headers($headerRaw);
    $body = "access_token={$config['accessToken']}&user_id={$config['userId']}&game_id=".$gameId;
    
    $result = requestPost($url,$headers,$body);

    $array = json_decode($result,true);
    
    if($array["status"] == "success")
    {
      
      $idStartGame = $array["data"]["id"];
      
      echo "{$white}".$i.".{$green} Play Game{$white} ".$nameGame."\n";
      
      $minutes = $minTime / 60;
      
      for($min = ($minutes - 1);$min >= 0;$min-- )
      {
        
        for($sec = 59;$sec >= 0;$sec--)
        {
          
          if($sec < 10)
          {
            
            echo "    [ 0".$min." : 0".$sec." ]\r";
            
          }
          else 
          {
          
            echo "    [ 0".$min." : ".$sec." ]\r";
            
          }
          
          sleep(1);
          
        }
        
        //sleep(1);
        
      }
      
      //echo "{$white}   wait.. ".$minutes." minutes"."\r";
      
    // sleep(120);
      
      echo endGame($idStartGame);
      
      $i++;
      
    }
    
  
  }
  
}

?>