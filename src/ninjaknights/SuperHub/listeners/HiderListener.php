<?php
namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

class HiderListener implements Listener
{

    public function onInteract(PlayerInteractEvent $event)
    {
        $main = Main::getInstance();
        $player = $event->getPlayer();
        $name = $player->getName();
        $item = $event->getPlayer()->getInventory()->getItemInHand()->getCustomName();
        $config = Main::getInstance()->getConfig();

        if ($config->getNested('player_hider.enabled', true)) {
            if ($item == $config->getNested('player_hider.hidden.display_name')) {
                $main->getHidePlayerItem()->getNotHiddenItem($player);
                $main->showall[] = $name;
                unset($main->shownone[array_search($name, $main->shownone)]);
            }

            if ($item == $config->getNested('player_hider.not_hidden.display_name')) {
                $main->getHidePlayerItem()->getHideItem($player);
                $main->shownone[] = $name;
                unset($main->showall[array_search($name, $main->showall)]);
            }
        }
    }
}