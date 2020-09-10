<?php

namespace NinjaKnights\SuperHub\Listener;

use NinjaKnights\SuperHub\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

class PlayerListener implements Listener
{
    private $plugin;
    public function __construct(Main $caller){
        $this->plugin = $caller;
    }

    public function onChat(PlayerChatEvent $event){
        if($event->isCancelled()) return;
        if($this->plugin->getAPI()->isChatLocked() && !$event->getPlayer()->hasPermission("superhub.chat.bypass")){
            $event->setCancelled();
            // %permission_missing%
            $event->getPlayer()->sendMessage(Main::PREFIX.TextFormat::RED." You don't have permission to chat");
        }
    }
}