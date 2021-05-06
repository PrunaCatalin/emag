<?php
/*
 * emag | BattleResults.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 5/6/2021 11:12 PM    
*/

namespace Emag\Engine\Game;


use Emag\Engine\Players\Player;

interface BattleResultInterface
{
    public function setWinner(Player $player) :  BatlleResult;
    public function getWinner() : ?Player;
    public function setTurn(int $turns) : BatlleResult;
    public function getTurn() : int;

}
