<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\Listener;

class CommandListener implements Listener
{

    private mixed $commands;

    public function __construct()
    {
        $this->commands = Main::getInstance()->getConfig()->getNested("command_block.blocked_commands", []);
    }

    public function removeDefaultCommands(): void
    {
        if(Main::getInstance()->getConfig()->getNested("command_block.enabled", true)) {
            $map = Main::getInstance()->getServer()->getCommandMap();
            foreach ($this->commands as $cmdname) {
                $cmd = $map->getCommand($cmdname);
                if ($cmd != null) {
                    $map->unregister($cmd);
                }
            }
        }
    }

}