<?php

namespace ninjaknights\SuperHub;

use ninjaknights\SuperHub\Commands\ChatCommand;
use ninjaknights\SuperHub\commands\FlyCommand;
use ninjaknights\SuperHub\commands\LobbyCommand;
use ninjaknights\SuperHub\commands\SetLobbyCommand;
use ninjaknights\SuperHub\commands\VanishCommand;
use ninjaknights\SuperHub\listeners\CommandListener;
use ninjaknights\SuperHub\listeners\HiderListener;
use ninjaknights\SuperHub\listeners\JoinListener;
use ninjaknights\SuperHub\listeners\LaunchListener;
use ninjaknights\SuperHub\listeners\PlayerListener;
use ninjaknights\SuperHub\listeners\WorldListener;
use ninjaknights\SuperHub\listeners\ChatListener;
use ninjaknights\SuperHub\tasks\HideTask;
use ninjaknights\SuperHub\util\HidePlayerItem;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase
{

    public const PREFIX = TextFormat::GREEN."[SuperHub]".TextFormat::RESET;
    private static Main $instance;
    private API $api;
    private CommandListener $command;
    private HidePlayerItem $hideplayeritem;
    public array $showall = array(" ");
    public array $shownone = array(" ");

    protected function onLoad(): void
    {
        self::$instance = $this;
        if (!file_exists($this->getDataFolder() . "config.yml")) {
            $this->saveResource("config.yml");
        }
    }

    public function onEnable(): void
    {
        $this->getTasks();
        $this->getListeners();
        $this->registerCommands();
        $this->api = new API();
        $this->command = new CommandListener();
        $this->hideplayeritem = new HidePlayerItem();
        $this->getCommandListener()->removeDefaultCommands();
    }

    /**
     * @return API
     */
    public function getAPI(): API
    {
        return $this->api;
    }

    public function getCommandListener(): CommandListener
    {
        return $this->command;
    }

    public function getHidePlayerItem(): HidePlayerItem
    {
        return $this->hideplayeritem;
    }

    public function getListeners()
    {
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WorldListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new HiderListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new JoinListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new CommandListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new LaunchListener(), $this);
    }

    public function getTasks()
    {
        $this->getScheduler()->scheduleRepeatingTask(new HideTask(), 20);
    }

    public function registerCommands()
    {
        $this->getServer()->getCommandMap()->register("superhub", new ChatCommand($this, "chat", "Chat Commands"));
        $this->getServer()->getCommandMap()->register("superhub", new SetLobbyCommand($this, "setlobby", "Set Lobby"));
        $this->getServer()->getCommandMap()->register("superhub", new LobbyCommand($this, "lobby", "Teleport to Lobby"));
        $this->getServer()->getCommandMap()->register("superhub", new FlyCommand($this, "fly", "Allow Flight"));
        $this->getServer()->getCommandMap()->register("superhub", new VanishCommand($this, "vanish", "Makes you invisible"));
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}
