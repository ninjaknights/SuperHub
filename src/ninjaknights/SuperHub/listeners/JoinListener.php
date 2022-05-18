<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use ninjaknights\SuperHub\tasks\AnnouncementTask;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\world\sound\Sound;

class JoinListener implements Listener
{

    public function onJoin(PlayerJoinEvent $event)
    {
        $main = Main::getInstance();
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = Main::getInstance()->getConfig();
        $spawn = $player->getWorld()->getSpawnLocation();

        /*
         * Join Connected Message
         */
        if($config->getNested('join_leave_messages.enabled', true)) {
            $msg = str_replace(
                ["&", "[LINE]", "[PLAYER]"],
                ["§", "\n", "$name"],
                $config->getNested('join_leave_messages.join_message')
            );
            $event->setJoinMessage($msg);
        }

        /*
         * Join Message
         */
        if($config->getNested('join_events.join_message.enabled', true)) {
            $msg = str_replace(
                ["&", "[LINE]", "[PLAYER]"],
                ["§", "\n", "$name"],
                $config->getNested('join_events.join_message.message', [])
            );
            foreach($msg as $test) {
                $player->sendMessage($test);
            }
        }

        /*
         * Join Title
         */
        if($config->getNested('join_events.join_title.enabled', true)) {
            $title = str_replace(
                ["&", "[LINE]", "[PLAYER]"],
                ["§", "\n", "$name"],
                $config->getNested('join_events.join_title.title')
            );
            $subtitle = str_replace(
                ["&", "[LINE]", "[PLAYER]"],
                ["§", "\n", "$name"],
                $config->getNested('join_events.join_title.subtitle')
            );
            $fadein = $config->getNested('join_events.join_title.fade_in');
            $stay = $config->getNested('join_events.join_title.stay');
            $fadeout = $config->getNested('join_events.join_title.fade_out');
            $player->sendTitle($title, $subtitle, $fadein, $stay, $fadeout);
        }

        /*
         * Join Sound
         */
        if($config->getNested('join_events.join_sound.enabled', true)) {
            $sound = $config->getNested('join_events.join_sound.sound');
            $player->broadcastSound(self::playSound($sound));
        }

        /*
         * Join Effect
         */
        if($config->getNested('join_events.join_effect.enabled', true)) {
            $effects = $config->getNested('join_events.join_effect.effect', []);
            $duration = $config->getNested('join_events.join_effect.duration');
            foreach($effects as $effect) {
                $player->getEffects()->add(new EffectInstance(VanillaEffects::$effect(), 20 * $duration));
            }
        }

        /*
         * Spawn Join
         */
        if($config->getNested('join_settings.spawn_join', true)) {
            $player->teleport($spawn);
        }

        /*
         * Heal
         */
        if($config->getNested('join_settings.heal', true)) {
            $player->setHealth(20);
        }

        /*
         * Extinguish
         */
        if($config->getNested('join_settings.extinguish', true)) {
            $player->extinguish();
        }

        /*
         * Clear Inventory
         */
        if($config->getNested('join_settings.clear_inventory', true)) {
            $player->getInventory()->clearAll();
        }

        /*
         * Auto Broadcast
         */
        if($config->getNested('announcements.enabled', true)) {
            $delay = $config->getNested('announcements.delay');
            $playercount = $config->getNested('announcements.required_players');
            $count = count($main->getServer()->getOnlinePlayers());
            if($count >= $playercount) {
                $main->getScheduler()->scheduleRepeatingTask(new AnnouncementTask(), 20 * $delay);
            }
        }

        /*
         * Player Hider
         */
        if($config->getNested('player_hider.enabled', true)) {
            if (!in_array($name, $main->showall) && !in_array($name, $main->shownone)) {

                $main->showall[] = $name;

            }
            if (in_array($name, $main->showall)) {
                $main->getHidePlayerItem()->getNotHiddenItem($player);
            } elseif (in_array($name, $main->shownone)) {
                $main->getHidePlayerItem()->getHideItem($player);
            }
        }

    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = Main::getInstance()->getConfig();

        /*
         * Quit Disconnected Message
         */
        if($config->getNested('join_leave_messages.enabled', true)) {
            $msg = str_replace(
                ["&", "[LINE]", "[PLAYER]"],
                ["§", "\n", "$name"],
                $config->getNested('join_leave_messages.quit_message')
            );
            $event->setQuitMessage($msg);
        }

    }

    protected static function playSound(string $sound) : Sound
    {
        $sound = "pocketmine\\world\\sound\\".$sound."Sound";
        return new $sound;
	}

}