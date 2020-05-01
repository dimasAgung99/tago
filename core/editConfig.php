<?php

function editConfig()
{
  
    $file = __DIR__."/../config.json";
    $array = [];
    
    echo "• access token : "; $access_token = trim(fgets(STDIN));
    echo "• user id : "; $user_id = trim(fgets(STDIN));
    echo "• aid : "; $aid = trim(fgets(STDIN));
    echo "• token : "; $token = trim(fgets(STDIN));
    echo "• user agent : "; $user_agent = trim(fgets(STDIN));
    
    $array["accessToken"] = $access_token;
    $array["userId"] = $user_id;
    $array["aid"] = $aid;
    $array["token"] = $token;
    $array["userAgent"] = $user_agent;
    
    $json = json_encode($array);
    
    $open = fopen($file,"w+");
    fwrite($open,$json);
    fclose($open);
    
}

?>