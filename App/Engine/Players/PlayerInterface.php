<?php
/*
 * emag | PlayerInterface.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 4/30/2021 10:17 PM    
*/

namespace Emag\Engine\Players;


interface PlayerInterface
{
    /**
     * @return string
     */
    public function getName(  ): string;
    /**
     * @param string $name
     * @return Player
     */
    public function setName( string $name ): Player;
    /**
     * @return int
     */
    public function getHealth(): int;
    /**
     * @param int $health
     * @return Player
     */
    public function setHealth( int $health ): Player;
    /**
     * @return int
     */
    public function getStrength() : int;
    /**
     * @param int $strength
     * @return Player
     */
    public function setStrength( int $strength ): Player;
    /**
     * @return int
     */
    public function getDefence(): int ;
    /**
     * @param int $defence
     * @return Player
     */
    public function setDefence( int $defence ): Player;
    /**
     * @return int
     */
    public function getSpeed() : int;
    /**
     * @param int $speed
     * @return Player
     */
    public function setSpeed( int $speed ): Player;
    /**
     * @return int
     */
    public function getLuck() : int;
    /**
     * @param int $luck
     * @return Player
     */
    public function setLuck( int $luck ): Player;
    /**
     * @param string $spell
     * @return Player
     */
    public function setSpell(string $spell): Player;
}
