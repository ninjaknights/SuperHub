<?php

namespace ninjaknights\SuperHub\commands\chat;

use ninjaknights\SuperHub\Main;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

class LockChat extends BaseSubCommand
{

    protected function prepare() : void
    {

    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {

        if(Main::getInstance()->getAPI()->lockChat($sender->getName())) {
            $sender->sendMessage("Chat locked");
        } else {
            $sender->sendMessage("The chat is already locked!");
        }

    }
}