<?php
/*
 * emag | BatlleResult.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 5/6/2021 11:24 PM    
*/

namespace Emag\Engine\Game;

use Emag\Engine\Players\Player;

class BatlleResult implements BattleResultInterface
{
    private ?Player $winner = null;
    private int $turn = 0;
    public function setWinner(Player $player): BatlleResult
    {
        $this->winner = $player;
        return $this;
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }

    public function setTurn(int $turn): BatlleResult
    {
        $this->turn = $turn;
        return $this;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }
}
