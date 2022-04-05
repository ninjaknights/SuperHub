<?php

namespace ninjaknights\SuperHub\commands;

use CortexPE\Commando\BaseCommand;
use ninjaknights\SuperHub\commands\chat\ClearChat;
use ninjaknights\SuperHub\commands\chat\LockChat;
use ninjaknights\SuperHub\commands\chat\UnlockChat;
use pocketmine\command\CommandSender;

class ChatCommand extends BaseCommand
{

    protected function prepare() : void
    {
        $this->registerSubCommand(new ClearChat('clear', 'Clears Chat'));
        $this->registerSubCommand(new LockChat('lock', 'Lock Chat'));
        $this->registerSubCommand(new UnlockChat('unlock', 'Lock Chat'));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {
        $this->sendUsage();
    }

}