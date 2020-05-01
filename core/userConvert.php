<?php

function userConvert()
{
  
  global $green,$white;
  
  $config = config();
  
  $url = "https://tago.games/prod/api/user/convert?access_token={$config['accessToken']}&user_id=".$config['userId'];
  
  $headerRaw = "Accept-Language: in-ID,in;q=0.8
User-Agent: {$config['userAgent']}
Host: tago.games";
  
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

?>