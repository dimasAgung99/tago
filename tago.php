<?php

error_reporting(1);

$red = "\e[91m";
$green = "\e[92m";
$orange = "\e[38;5;208m";
$white = "\e[97m";
$yellow = "\e[93m";
$bold = "\e[1m";


require_once __DIR__.'/core/selectConfig.php';
selectConfig();
require_once __DIR__.'/core/editConfig.php';
require_once __DIR__.'/core/logo.php';
require_once __DIR__.'/core/config.php';
require_once __DIR__.'/core/request.php';
require_once __DIR__.'/core/userInit.php';
require_once __DIR__.'/core/userDashboard.php';
require_once __DIR__.'/core/userDailyBonus.php';
require_once __DIR__.'/core/userCoinEarn.php';
require_once __DIR__.'/core/userConvert.php';
require_once __DIR__.'/core/userGames.php';
require_once __DIR__.'/core/startGame.php';
require_once __DIR__.'/core/endGame.php';


userInit();
userDashboard();
userConvert();
userDailyBonus();
userCoinEarn();
startGame();

