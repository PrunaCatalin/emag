<?php
/*
 * emag | AiPlayerInterface.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 4/30/2021 10:07 PM    
*/

namespace Emag\Engine\Players;

/*
 * Interface AiPlayerInterface
 */
interface AiPlayerInterface
{
    /**
     * @return string
     */
    public function getName(  ): string;
    /**
     * @param string $name
     * @return AiPlayer
     */
    public function setName( string $name ): AiPlayer;
    /**
     * @return int
     */
    public function getHealth(): int;
    /**
     * @param int $health
     * @return AiPlayer
     */
    public function setHealth( int $health ): AiPlayer;
    /**
     * @return int
     */
    public function getStrength() : int;
    /**
     * @param int $strength
     * @return AiPlayer
     */
    public function setStrength( int $strength ): AiPlayer;
    /**
     * @return int
     */
    public function getDefence(): int ;
    /**
     * @param int $defence
     * @return AiPlayer
     */
    public function setDefence( int $defence ): AiPlayer;
    /**
     * @return int
     */
    public function getSpeed() : int;
    /**
     * @param int $speed
     * @return AiPlayer
     */
    public function setSpeed( int $speed ): AiPlayer;
    /**
     * @return int
     */
    public function getLuck() : int;
    /**
     * @param int $luck
     * @return AiPlayer
     */
    public function setLuck( int $luck ): AiPlayer;
}
