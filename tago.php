<?php


error_reporting(1);

system ("clear");

function config()
{
  
  $config = [];
  $config["accessToken"] = "SfTGNKCJdKnvtrLGsKNitx33";
  $config["userId"] = "410158";
  $config["aid"] = "a0e82c1536512fd3";
  $config["token"] = "ecp0MuaTEmg%3AAPA91bEGesFIMzHmael08Ve3S8SIgKCXL0C0tssBLD0EIEmrUnPde1a5ERXl6UjWf7-Uoae8Y4srV-xWe3csn0M1juuPCjhu6dyzu6SD7iyDUYnjtULkEonO27RyA-Dw6CGLIPvMW5Be";
  $config['userAgent'] = "Dalvik/2.1.0 (Linux; U; Android 5.1.1; Redmi 3 MIUI/V7.2.1.0.LHPMIDB)";
  
  return $config;
  
}


$red = "\e[91m";
$green = "\e[92m";
$orange = "\e[38;5;208m";
$yellow = "\e[93m";
$white = "\e[97m";
$bold = "\e[1m";

echo "$bold{$red}
 ______   ______     ______     ______    
/\__  _\ /\  __ \   /\  ___\   /\  __ \   
\/_/\ \/ \ \  __ \  \ \ \__ \  \ \ \/\ \  
$orange   \ \_\  \ \_\ \_\  \ \_____\  \ \_____\ 
    \/_/   \/_/\/_/   \/_____/   \/_____/ 
                                          
$white";

echo "creator : dimasAgung\n\n\n";


function requestPost($url,$headers,$body)
{
  
  $ch = curl_init();
  
  curl_setopt_array($ch,[
    
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER => 1
    
    ]);
  
  $result = curl_exec($ch);
  
  curl_close($ch);
  
  return $result;
  
}

function requestGet($url,$headers)
{
  
  $ch = curl_init();
  
  curl_setopt_array($ch,[
    
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER => 1
    
    ]);
  
  $result = curl_exec($ch);
  
  curl_close($ch);
  
  return $result;
  
}

function headers($headerRaw)
{
  
  return explode("\n",$headerRaw);
  
}

function userInit()
{
  
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/init?access_token={$config['accessToken']}&user_id={$config['userId']}&aid={$config['aid']}&token=".$config['token'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Authorization: Basic dGFnb19pY2FuOkQnMyouQC00SG5yQEx7fi8=
Host: tago.games
Connection: Keep-Alive";

  $headers = headers($headerRaw);
  
  $result = requestGet($url,$headers);
  
  $array = json_decode($result,true);
  
  
  
  if($array["status"] != "success")
  {
    
    exit($result);
    
  }
  
  
}

function userDashboard()
{
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/dashboard?access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Host: tago.games
Connection: Keep-Alive";
  
  $headers = headers($headerRaw);
  
  $result = requestGet($url,$headers);
  
  //echo $result;
  
}

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
    
    echo "{$green}•{$white} Daily Bonus ~{$green} Day ".$day."{$white} ->{$yellow} Besok\n\n";
    
  }
  else 
  {
    
    extract($array['data']);
    
    echo "{$green}•{$white} Daily Bonus ~{$yellow} Day ".$day."{$white} ->{$green} ".$array['message']."\n\n";
    
  }
  
}

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
      
      
      sleep(30);
    
  
    }
    
    sleep(5);
  
  }
  
}

function userConvert()
{
  
  global $green,$white;
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/convert?access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Host: tago.games
Connection: Keep-Alive";
  
  $headers = headers($headerRaw);
  
  $result = requestGet($url,$headers);
  
  $array = json_decode($result,true);
  
  if($array["status"] == "success")
  {
    
    $dataUser = $array["data"]["user"];
    
    $fname = $dataUser["first_name"];
    
    $lname = $dataUser["last_name"];
    
    //$email = $dataUser["email"];
    
    $balance = $dataUser["balance"];
    
    $amount = $dataUser["amount"];
    
    //$stageCompleted = $dataUser["stage_completed"];
    
    echo "{$green}[{$white} ".$fname." ".$lname." {$green}]\n\n";
    
    echo "{$green}[{$white} ".$balance." = $ ".$amount." {$green}]\n\n\n";
    
    
    
  }
  else 
  {
    
    exit($result);
    
  }
  
}

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
  
  $array = json_decode($result,true);
  
  if($array["status"] == "success")
  {
    
    $dataLength = count ($array["data"]);
    
    $randomId = rand(0,$dataLength);
    //return $array["data"][0];
    return $array["data"][$randomId];
    
  }
  
}

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
    
    $minTime = $userGames["min_time"];
    
    $url = "https://tago.games/prod/api/game/mulai";
  
    $headerRaw = "Accept-Language: in-ID,in;q=0.8
  User-Agent: {$config['userAgent']}
  Content-Type: application/x-www-form-urlencoded
  Host: tago.games
  Connection: Keep-Alive";
  
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
      
      //sleep($minTime);
      
      echo EndGame($idStartGame);
      
      $i++;
      
    }
    
  
  }
  
}

function EndGame($idStartGame)
{
  
  global $green,$white;
  
  $config = config();
  
  $url = "https://tago.games/prod/api/game/akhir";
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Content-Type: application/x-www-form-urlencoded
Host: tago.games
Connection: Keep-Alive";
  
  $headers = headers($headerRaw);
  
  $body = "access_token={$config['accessToken']}&user_id={$config['userId']}&id={$idStartGame}&contare=".rand(50,100);
  
  $result = requestPost($url,$headers,$body);
  
  $array = json_decode($result,true);
  
  if($array["status"] == "success")
  {
    
    //return $result;
  
    
    return "{$green}   ~{$white} Reward +{$GLOBALS['yellow']} ".$array["data"]["reward"]." {$green}~\n\n";
    /*
    return "Reward + ".$array["data"]["reward"]."\n";*/
  
  }
  else
  {
    
    return userInit();
    
  }
  
}



userInit();

userDashboard();

userConvert();

userDailyBonus();

userCoinEarn();

startGame();
