<?php

namespace NinjaKnights\SuperHub\Commands;

use NinjaKnights\SuperHub\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;

class ChatCommand extends PluginCommand
{
    private $plugin;

    public function __construct(Main $owner)
    {
        $this->plugin = $owner;
        parent::__construct("chat", $owner);
        $this->setPermission("superhub.commands.chat");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        /*
         * Usage of /chat
         * /chat lock
         * /chat unlock
         * /chat clear
         */
        if(!$this->testPermission($sender)) return false;
        if(count($args) == 0){
            //Bad usage! Command should have atleast 1argument
            $sender->sendMessage(Main::PREFIX.TextFormat::RED."");
        }
        //usage of switch to allow different args
        switch (strtolower($args[0])){
            case 'lock':
            case 'l':
                if($this->plugin->getAPI()->lockChat($sender->getName()))
                    $sender->sendMessage(Main::PREFIX. TextFormat::GREEN."Chat locked");
                else
                    $sender->sendMessage(Main::PREFIX.TextFormat::RED."The chat is already locked!");
                break;
            case 'unlock':
                if($this->plugin->getAPI()->lockChat($sender->getName(), false))
                    $sender->sendMessage(Main::PREFIX. TextFormat::GREEN."Chat unlocked");
                else
                    $sender->sendMessage(Main::PREFIX.TextFormat::RED."The chat is already unlocked!");
                break;
            case 'clear':
            case 'reset':
                //i really don't know if it works
                $this->plugin->getServer()->broadcastMessage(str_repeat("\n", 1000));
                $sender->sendMessage(Main::PREFIX.TextFormat::YELLOW."You successfully cleared chat!");
                break;
        }
        return true;
    }
}