<?php
/*
 * emag | LogEvents.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 5/7/2021 1:36 AM    
*/

namespace Emag\Engine\Game;

class LogEvents
{
    public static function log(string $message){
        if(php_sapi_name() === "cli"){
            print $message."\n";
        }else{
            echo $message."<br>";
        }

    }
}
