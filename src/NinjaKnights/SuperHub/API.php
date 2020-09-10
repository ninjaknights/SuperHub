<?php

namespace NinjaKnights\SuperHub;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class API
{
    private $plugin;
    private $server;
    private $config;


    private $isChatLocked = false;


    public function __construct(Main $caller)
    {
        $this->plugin = $caller;
        $this->server = $caller->getServer();
        $this->loadConfig();
    }

    private function loadConfig(){
        if(!file_exists($this->plugin->getDataFolder()."config.yml"))
            $this->plugin->saveResource("config.yml");
        $this->config = new Config($this->plugin->getDataFolder()."config.yml", Config::YAML);
    }

    /*
     * Chat Functions
     */
    public function isChatLocked() : bool{
        return $this->isChatLocked;
    }

    private function setChatLocked(bool $locked = true){
        $this->isChatLocked = $locked;
    }

    // $author is not a Player in case it's the Console
    public function lockChat(string $author, bool $locked =  true) : bool{
        if($this->isChatLocked() == $locked) return false;
        $this->setChatLocked($locked);
        if($locked){
            //Chat closed by $author
            $this->server->broadcastMessage(Main::PREFIX.TextFormat::RED." Chat Closed by {$author}");
        }else{
            //Chat opened by $author
            $this->server->broadcastMessage(Main::PREFIX.TextFormat::GREEN."Chat Opened by {$author}");
        }
        return true;
    }
}