<?php

namespace ninjaknights\SuperHub\tasks;

use ninjaknights\SuperHub\Main;
use pocketmine\scheduler\Task;

class HideTask extends Task
{
    public function onRun(): void
    {
        foreach(Main::getInstance()->getServer()->getOnlinePlayers() as $player) {
            $main = Main::getInstance();
            $name = $player->getName();
            $players = $player->getWorld()->getPlayers();
            foreach ($players as $play) {
                if (in_array($name, $main->showall)) {
                    $player->showPlayer($play);
                }  elseif (in_array($name, $main->shownone)) {
                    $player->hidePlayer($play);
                }
            }
        }
    }
}