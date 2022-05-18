<?php

namespace ninjaknights\SuperHub\commands;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class FlyCommand extends BaseCommand
{

    protected function prepare() : void
    {

    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {
        if (!$sender instanceof Player) return;
        switch ($sender->getAllowFlight()) {
            case true:
                $sender->setAllowFlight(false);
                break;
            case false:
                $sender->setAllowFlight(true);
        }
    }

}