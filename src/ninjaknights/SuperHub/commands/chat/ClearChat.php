<?php

namespace ninjaknights\SuperHub\commands\chat;

use ninjaknights\SuperHub\Main;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

class ClearChat extends BaseSubCommand
{

    protected function prepare() : void
    {

    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {
        Main::getInstance()->getServer()->broadcastMessage(str_repeat("\n", 100));
        $sender->sendMessage("You successfully cleared chat!");
    }

}