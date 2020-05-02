<?php



echo "\n\n[?] edit config [ y / press any key to continue ] : "; $pilih = trim(fgets(STDIN));
if($pilih == "y")
{
  
  echo "\n";
  editConfig();
  
}

system ("clear");

echo $logo = "$bold{$red}
 ______   ______     ______     ______    
/\__  _\ /\  __ \   /\  ___\   /\  __ \   
\/_/\ \/ \ \  __ \  \ \ \__ \  \ \ \/\ \  
$orange   \ \_\  \ \_\ \_\  \ \_____\  \ \_____\ 
    \/_/   \/_/\/_/   \/_____/   \/_____/ 
                                          
$orange";

echo str_repeat("-",40);
echo "\n\n\n$white";


?>