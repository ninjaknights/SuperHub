<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class PlayerListener implements Listener
{

    public function onItemDrop(PlayerDropItemEvent $event)
    {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_item_drop', true)) {
            $event->cancel();
        }
    }

    public function onItemPickup(EntityItemPickupEvent $event)
    {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_item_pickup', true)) {
            $event->cancel();
        }
    }

    public function onExhaust(PlayerExhaustEvent $event)
    {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_hunger_loss', true)) {
            $event->cancel();
        }
    }

    public function onInteract(PlayerInteractEvent $event) {
        if(Main::getInstance()->getConfig()->getNested('world_settings.disable_block_interact', true)) {
            $event->cancel();
        }
    }

    public function onDamage(EntityDamageEvent $event)
    {
        $config = Main::getInstance()->getConfig();

        /*
         * Fall Damage
         */
        if($config->getNested('world_settings.disable_fall_damage', true)) {
            if($event->getCause() == 4) {
                $event->cancel();
            }
        }

        /*
         * Fire Damage
         */
        if($config->getNested('world_settings.disable_fire_damage', true)) {
            if($event->getCause() == 5) {
                $event->cancel();
            }
        }

        /*
         * Drowning
         */
        if($config->getNested('world_settings.disable_drowning', true)) {
            if($event->getCause() == 8) {
                $event->cancel();
            }
        }

        /*
         * Void Death
         */
        if($config->getNested('world_settings.disable_void_death', true)) {
            if($event->getCause() == 11) {
                $event->cancel();
            }
        }

        /*
         * Player PvP
         */
        if($config->getNested('world_settings.disable_player_pvp', true)) {
            if($event->getCause() == 1) {
                $event->cancel();
            }
        }

    }

}