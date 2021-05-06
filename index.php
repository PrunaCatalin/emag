<?php
/*
 * emag | index.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 5/6/2021 10:31 PM    
*/
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define("ENVIROMENT",__DIR__."/.env");
require_once __DIR__.'/vendor/autoload.php';
include "./App/Engine/Game/GameService.php";
$gameObject = new \Emag\Engine\Game\GameService();
$gameObject->run();


