<?php

namespace ninjaknights\SuperHub\util;

use ninjaknights\SuperHub\Main;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class HidePlayerItem
{
    public function getHideItem(Player $player): void
    {
        $inv = $player->getInventory();
        $config = Main::getInstance()->getConfig();
        $name = $player->getName();

        $material = $config->getNested('player_hider.hidden.material');
        $lore = str_replace(
            ["&", "[LINE]", "[PLAYER]"],
            ["§", "\n", "$name"],
            $config->getNested('player_hider.hidden.lore', [])
        );
        $amount = $config->getNested('player_hider.hidden.amount');
        $slot = $config->getNested('player_hider.slot');
        $displayname = $config->getNested('player_hider.hidden.display_name');

        $item = VanillaItems::$material();
        $item->setCustomName($displayname);
        $item->setLore($lore);
        $item->setCount($amount);
        $inv->setItem($slot, $item);
    }

    public function getNotHiddenItem(Player $player): void
    {
        $inv = $player->getInventory();
        $config = Main::getInstance()->getConfig();
        $name = $player->getName();

        $material = $config->getNested('player_hider.not_hidden.material');
        $lore = str_replace(
            ["&", "[LINE]", "[PLAYER]"],
            ["§", "\n", "$name"],
            $config->getNested('player_hider.not_hidden.lore', [])
        );
        $amount = $config->getNested('player_hider.not_hidden.amount');
        $slot = $config->getNested('player_hider.slot');
        $displayname = $config->getNested('player_hider.not_hidden.display_name');

        $item = VanillaItems::$material();
        $item->setCustomName($displayname);
        $item->setLore($lore);
        $item->setCount($amount);
        $inv->setItem($slot, $item);
    }
}