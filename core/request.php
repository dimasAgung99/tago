<?php


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

?>