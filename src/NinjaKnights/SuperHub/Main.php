<?php

namespace NinjaKnights\SuperHub;

use NinjaKnights\SuperHub\Commands\ChatCommand;
use NinjaKnights\SuperHub\Listener\PlayerListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public const PREFIX = TextFormat::GREEN."[SuperHub]".TextFormat::RESET;
    private $api;

    public function onLoad()
    {
        $commands = [new ChatCommand($this)];
        $this->getServer()->getCommandMap()->registerAll("superhub", $commands);
    }

    public function onEnable() {
        //stuff
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener($this), $this);
        $this->api = new API($this);
    }

    /**
     * @return API
     */
    public function getAPI() : API{
        return $this->api;
    }
}
