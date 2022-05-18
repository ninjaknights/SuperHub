<?php

namespace ninjaknights\SuperHub;

use pocketmine\utils\TextFormat;

class API
{

    private bool $isChatLocked = false;

    public function isChatLocked(): bool
    {
        return $this->isChatLocked;
    }

    private function setChatLocked(bool $locked = true)
    {
        $this->isChatLocked = $locked;
    }

    public function lockChat(string $author, bool $locked =  true): bool
    {
        if($this->isChatLocked() == $locked) return false;
        $this->setChatLocked($locked);
        if($locked) {
            Main::getInstance()->getServer()->broadcastMessage(Main::PREFIX.TextFormat::RED." Chat Closed by $author");
        } else {
            Main::getInstance()->getServer()->broadcastMessage(Main::PREFIX.TextFormat::GREEN." Chat Opened by $author");
        }
        return true;
    }
}