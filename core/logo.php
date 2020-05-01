<?php



echo "\n\nedit config? [ y / press any key to continue ] : "; $pilih = trim(fgets(STDIN));
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
                                          
$white";

$pembatas = str_repeat('-',40);

echo $pembatas."\n";
echo "\tcreator : dimasAgung\n";
echo $pembatas."\n\n\n";


?>