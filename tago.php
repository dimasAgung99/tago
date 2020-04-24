<?php


error_reporting(1);


/*
echo "\n\nmasukan config : ";$pilihConfig = trim(fgets(STDIN));

if(file_exists($pilihConfig))
{
  */
  require("config.php");
  /*
}
else 
{
  
  exit("config not found");
  
}*/



function config()
{
  
  global $accessToken,$userId,$aid,$token,$userAgent;
  
  $config = [];
  $config["accessToken"] = $accessToken;
  $config["userId"] = $userId;
  $config["aid"] = $aid;
  $config["token"] = $token;
  $config['userAgent'] = $userAgent;
  
  return $config;
  
}



system ("clear");

echo $logo = "$bold{$red}
 ______   ______     ______     ______    
/\__  _\ /\  __ \   /\  ___\   /\  __ \   
\/_/\ \/ \ \  __ \  \ \ \__ \  \ \ \/\ \  
$orange   \ \_\  \ \_\ \_\  \ \_____\  \ \_____\ 
    \/_/   \/_/\/_/   \/_____/   \/_____/ 
                                          
$white";

$pembatas = str_repeat('-',40);

echo $pembatas."\n";
echo "\tcreator : dimasAgung\n";
echo $pembatas."\n\n\n";


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
  
  a:
  $result = requestGet($url,$headers);
  
  $array = json_decode($result,true);
  
  
  
  if($array["status"] != "success")
  {
    
    goto a;
    
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
  
    $headerRaw = "Accept-Language: in-ID,in;q=0.8
  User-Agent: {$config['userAgent']}
  Content-Type: application/x-www-form-urlencoded
  Host: tago.games
  Connection: Keep-Alive";
  
    $headers = headers($headerRaw);
    
    $body = "access_token={$config['accessToken']}&user_id={$config['userId']}&game_id=".$gameId;
    
    $result = requestPost($url,$headers,$body);
    
    //echo $result;
    
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
  
  //$body = "access_token={$config['accessToken']}&user_id={$config['userId']}&id={$idStartGame}";
  
  $result = requestPost($url,$headers,$body);
  
  //return $result;
  
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

//print_r(userGames());
