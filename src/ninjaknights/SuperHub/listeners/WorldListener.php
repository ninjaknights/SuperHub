<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;

class WorldListener implements Listener
{

    public function onBlockBreak(BlockBreakEvent $event)
    {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_block_break', true)) {
            $event->cancel();
        }
    }

    public function onBlockPlace(BlockPlaceEvent $event)
    {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_block_place', true)) {
            $event->cancel();
        }
    }


}