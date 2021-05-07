<?php
/*
 * emag | GameService.php
 * https://www.webdirect.ro/
 * Copyright 2021 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 5/6/2021 10:13 PM    
*/

namespace Emag\Engine\Game;

use Emag\Engine\Game\LogEvents;
use Emag\Engine\Players\AiPlayer;
use Emag\Engine\Players\Player;
class GameService
{
    private  Player $player;
    private  AiPlayer  $aiPlayer;
    private int $maxTurns ;

    public function __construct(){

        $file = parse_ini_file(ENVIROMENT);
        $this->player = (new Player())
            ->setName("Orderus")
            ->setHealth((int)(rand($file['PLAYER_MIN_HEALTH'],$file['PLAYER_MAX_HEALTH'])))
            ->setStrength((int)(rand($file['PLAYER_MIN_STRENGTH'],$file['PLAYER_MAX_STRENGTH'])))
            ->setDefence((int)(rand($file['PLAYER_MIN_DEFENCE'],$file['PLAYER_MAX_DEFENCE'])))
            ->setSpeed((int)(rand($file['PLAYER_MIN_SPEED'],$file['PLAYER_MAX_SPEED'])))
            ->setLuck((int)(rand($file['PLAYER_MIN_LUCK'],$file['PLAYER_MAX_LUCK'])));

        $this->aiPlayer  = (new AiPlayer())
            ->setName("Wild Best")
            ->setHealth((int)(rand($file['AI_PLAYER_MIN_HEALTH'],$file['AI_PLAYER_MAX_HEALTH'])))
            ->setStrength((int)(rand($file['AI_PLAYER_MIN_STRENGTH'],$file['AI_PLAYER_MAX_STRENGTH'])))
            ->setDefence((int)(rand($file['AI_PLAYER_MIN_DEFENCE'],$file['AI_PLAYER_MAX_DEFENCE'])))
            ->setSpeed((int)(rand($file['AI_PLAYER_MIN_SPEED'],$file['AI_PLAYER_MAX_SPEED'])))
            ->setLuck((int)(rand($file['AI_PLAYER_MIN_LUCK'],$file['AI_PLAYER_MAX_LUCK'])));
        $this->maxTurns = $file['GAME_TURNS'];
        LogEvents::log("Total rounds: ".$file['GAME_TURNS']);
    }
    public function run(){
        $this->gameLoop();
    }

    private function gameLoop() : BatlleResult {
        $attacker = $this->getFirstAttacker();
        $batlleResult = new BatlleResult();
        $playerDoubleAttack = false;

        for($turn = 1; $turn <= $this->maxTurns; $turn++){

            LogEvents::log("Turn is started : ".$turn);
            if($this->player->getHealth() > 0 && $this->aiPlayer->getHealth() > 0) {
                if ($attacker->getName() === "Orderus") {
                    $attacker = $this->aiPlayer;
                    //luck for  player
                    $this->player->setLuck(rand(0, 100));
                    $this->aiPlayer->setLuck(rand(0, 100));
                    LogEvents::log("Player luck  is : " . $this->player->getLuck());
                    //switch attacker for next turn

                    //check (0% means no luck).
                    if ($this->player->getLuck() === 0) {
                        LogEvents::log("Player no luck this turn : " . $turn);
                        continue;
                    }
                    //skill attacker logic
                    //total damage , strength player  compare with deface Ai and nor 100% luck
                    if ($this->player->getLuck() !== 100 || $playerDoubleAttack) {
                        LogEvents::log("Player luck is not 100% and can have change for spells ");
                        if ($this->player->getStrength() > $this->aiPlayer->getDefence()) {
                            LogEvents::log("Player have strength > aiPlayer defence ");
                            //luck 10%
                            if ($this->player->getLuck() > 10 && $this->player->getLuck() <= 30 || $playerDoubleAttack) {
                                LogEvents::log("Player have luck between 10% and 30 % or can double attack");
                                $totalDmg = abs($this->player->getStrength()  +
                                    ($this->player->getLuck() / 100)
                                );
                                $this->aiPlayer->setHealth($this->aiPlayer->getHealth() - $totalDmg);
                                LogEvents::log("AiPlayer Health after attack: " . $this->aiPlayer->getHealth());
                                LogEvents::log("Total dmg taken: " . $totalDmg);
                            } else if ($this->player->getLuck() === 10) { //change to strike again using Rapid strike
                                $this->aiPlayer->setHealth($this->aiPlayer->getHealth() - $this->player->getStrength());
                                $attacker = $this->player;
                                LogEvents::log("AiPlayer Health after attack: " . $this->aiPlayer->getHealth());
                                LogEvents::log("Total dmg taken: " . $this->player->getStrength());
                                LogEvents::log("Next attacker is :  " . $attacker->getName());
                                $playerDoubleAttack = true;
                            }
                        } else {
                            LogEvents::log("Player strength < AiPlayer defence ");
                        }

                    } else {
                        //luck 100%
                        $this->aiPlayer->setHealth($this->aiPlayer->getHealth() - $this->player->getStrength());
                        LogEvents::log("AiPlayer Health after player luck of 100% is :  " . $this->aiPlayer->getHealth());
                    }
                } else if ($attacker->getName() === "Wild Best" && $attacker->getHealth() > 1) {
                    $attacker = $this->player;
                    $this->aiPlayer->setLuck(rand(0, 100));
                    $this->player->setLuck(rand(0, 100));
                    LogEvents::log("Player Luck for this turn is :  " . $this->player->getLuck());
                    LogEvents::log("AiPlayer Luck for this turn is :  " . $this->aiPlayer->getLuck());
                    if ($this->player->getluck() == 20) { // use Magic shield change 20 %
                        LogEvents::log("Player can use Magic shield");
                        if ($this->player->getDefence() <= 45 && $this->player->getDefence() >= 55){
                            $totalDmg = $this->aiPlayer->getStrength() - ($this->aiPlayer->getStrength() * 0.2);
                            $this->player->setHealth($this->player->getHealth() - $totalDmg);
                        }
                    }
                    //Luck: 25% - 40%
                    if ($this->aiPlayer->getStrength() > $this->aiPlayer->getDefence()) {
                        LogEvents::log("AiPlayer have strength > Player defence");
                        if ($this->aiPlayer->getLuck() >= 25 && $this->aiPlayer->getLuck() <= 40) {
                            $totalDmg = ($this->aiPlayer->getStrength()  - $this->aiPlayer->getDefence() );
                            $this->player->setHealth($this->player->getHealth() - $totalDmg);
                            LogEvents::log("Player health after attack is: " . $this->player->getHealth());
                            LogEvents::log("Total dmg taken : " . $totalDmg);
                        } 
                    }

                }
            }
        }
        $this->decideWinner();
        return $batlleResult->setTurn($turn);
    }
    private function decideWinner(){
        if($this->player->getHealth() < $this->aiPlayer->getHealth())
            LogEvents::log("Winner is : ".$this->aiPlayer->getName());
        else
            LogEvents::log("Winner is : ".$this->player->getName());
    }
    private function getFirstAttacker() : Player{
        $first = $this->player;
        LogEvents::log("Decide First Attacker " );
        //use while instade of more returns
        while(true){
            if($this->player->getSpeed() > $this->aiPlayer->getSpeed()){
                LogEvents::log("Player is more fast than AiPlayer speed result is  : ".$this->player->getSpeed() );
                break;
            }else if($this->player->getSpeed()  === $this->aiPlayer->getSpeed()){
                LogEvents::log("Both have same speed and we base on luck this time");
                if($this->player->getLuck() >= $this->aiPlayer->getLuck()){
                    break;
                }else{
                    $first = $this->aiPlayer;
                    break;
                }
            }else{
                $first = $this->aiPlayer;
                break;
            }
        }
        LogEvents::log("Player :".$first->getName()." will start");
        return $first;
    }


}
