<?php

namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class ChatListener implements Listener
{

    public function onChat(PlayerChatEvent $event)
    {
        if($event->isCancelled()) return;
        if(Main::getInstance()->getAPI()->isChatLocked() && !$event->getPlayer()->hasPermission("superhub.chat.bypass")) {
            $event->cancel();
            $event->getPlayer()->sendMessage("You don't have permission to chat");
        }
    }
}