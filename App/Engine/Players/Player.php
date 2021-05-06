<?php
/*
 * emag | Player.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 4/29/2021 1:50 PM    
*/

namespace Emag\Engine\Players;
/*
 * Player Prototype
 */

use Emag\Engine\Game\LogEvents;

class Player implements PlayerInterface
{
    /**
     * Player name
     * Type String
     */
    private string $name;

    /**
     * Player health
     * Type Integer
     */
    private int $health;

    /**
     * Player strength
     * Type Integer
     */
    private int $strength;

    /**
     * Player defence
     * Type Integer
     */
    private int $defence;

    /**
     * Player speed
     * Type Integer
     */
    private int $speed;

    /*
     * Player luck
     * Type Integer
    */
    private int $luck;

    /**
     * Player name
     * Type String
     */
    private string $spell;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Player
     */
    public function setName(string $name): Player
    {
        $this->name = $name;
        LogEvents::log("Player name: ".$name);
        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return Player
     */
    public function setHealth(int $health): Player
    {
        $this->health = $health;
        LogEvents::log("Player health: ".$health);
        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return Player
     */
    public function setStrength(int $strength): Player
    {
        $this->strength = $strength;
        LogEvents::log("Player strength: ".$strength);
        return $this;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return Player
     */
    public function setDefence(int $defence): Player
    {
        $this->defence = $defence;
        LogEvents::log("Player defence: ".$defence);
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Player
     */
    public function setSpeed(int $speed): Player
    {
        $this->speed = $speed;
        LogEvents::log("Player speed: ".$speed);
        return $this;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     * @return Player
     */
    public function setLuck(int $luck): Player
    {
        $this->luck = $luck;
        LogEvents::log("Player luck: ".$luck);
        return $this;
    }

    /**
     * @return string
     */
    public function getSpell(): string
    {
        return $this->spell;
    }

    /**
     * @param string $spell
     * @return Player
     */
    public function setSpell(string $spell): Player
    {
        $this->spell = $spell;
        LogEvents::log("Player spell: ".$spell);
        return $this;
    }

}
