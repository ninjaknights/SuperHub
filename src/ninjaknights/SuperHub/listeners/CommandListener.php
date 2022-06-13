<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\Listener;

class CommandListener implements Listener
{

    public function removeDefaultCommands(): void
    {
        $commands = Main::getInstance()->getConfig()->getNested("command_block.blocked_commands", []);
        if(Main::getInstance()->getConfig()->getNested("command_block.enabled", true)) {
            $map = Main::getInstance()->getServer()->getCommandMap();
            foreach ($commands as $cmdname) {
                $cmd = $map->getCommand($cmdname);
                if ($cmd != null) {
                    $map->unregister($cmd);
                }
            }
        }
    }

}