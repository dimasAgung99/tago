<?php

function selectConfig()
{
  
  echo "\n\n•• list config ••\n\n";
  
  $dir = __DIR__."/../config/";
  
  if(is_dir($dir))
  {
    
    if($opendir = opendir($dir))
    {
      
      while ($file = readdir($opendir))
      {
        
        if($file == ".")
        {
          
          continue;
          
        }
        elseif($file == "..")
        {
          
          continue;
          
        }
        elseif($file == "select-config")
        {
          
          continue;
          
        }
        echo "  ".$file."\n";
    
      }
      
      closedir($opendir);
      
    }
    
  }
  echo "\n";
  echo "• pilih config : "; $pilihConfig = trim(fgets(STDIN));
  $file = __DIR__."/../config/select-config";
  $open = fopen($file,"w+");
  fwrite($open,$pilihConfig);
  fclose($open);
  
}

?>