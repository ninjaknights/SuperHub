<?php

namespace ninjaknights\SuperHub;

use ninjaknights\SuperHub\Commands\ChatCommand;
use ninjaknights\SuperHub\commands\LobbyCommand;
use ninjaknights\SuperHub\commands\SetLobbyCommand;
use ninjaknights\SuperHub\listeners\ChatListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase
{

    public const PREFIX = TextFormat::GREEN."[SuperHub]".TextFormat::RESET;
    private static Main $instance;
    private API $api;

    protected function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener(), $this);
        $this->api = new API();
        $this->getServer()->getCommandMap()->register("superhub", new ChatCommand($this, "chat", "Chat Commands"));
        $this->getServer()->getCommandMap()->register("superhub", new SetLobbyCommand($this, "setlobby", "Set Lobby"));
        $this->getServer()->getCommandMap()->register("superhub", new LobbyCommand($this, "lobby", "Teleport to Lobby"));
    }

    /**
     * @return API
     */
    public function getAPI(): API
    {
        return $this->api;
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}
