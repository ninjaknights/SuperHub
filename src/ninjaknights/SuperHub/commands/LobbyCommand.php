<?php

namespace ninjaknights\SuperHub\commands;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class LobbyCommand extends BaseCommand
{

    protected function prepare() : void
    {

    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {
        if ($sender instanceof Player) {
            $sender->teleport($sender->getWorld()->getSpawnLocation(), 0.0, 0.0);
        }
    }

}