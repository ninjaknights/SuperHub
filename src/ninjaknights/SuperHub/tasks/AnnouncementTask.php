<?php

namespace ninjaknights\SuperHub\tasks;

use ninjaknights\SuperHub\Main;
use pocketmine\scheduler\Task;

class AnnouncementTask extends Task
{

    public function onRun(): void
    {
        $config = Main::getInstance()->getConfig()->get('announcements');
        $announcement = $config["messages"][array_rand($config["messages"])];
        Main::getInstance()->getServer()->broadcastMessage($announcement);
    }
}