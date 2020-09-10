<?php

namespace NinjaKnights\SuperHub;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public const PREFIX = TextFormat::GREEN."[SuperHub]".TextFormat::RESET;
    private $api;

    public function onEnable() {
        //stuff
        $this->api = new API($this);
    }

    /**
     * @return API
     */
    public function getAPI() : API{
        return $this->api;
    }
}
