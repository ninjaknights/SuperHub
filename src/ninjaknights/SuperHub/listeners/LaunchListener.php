<?php
namespace ninjaknights\SuperHub\listeners;

use ninjaknights\SuperHub\Main;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;

class LaunchListener implements Listener
{

    /*
     * LaunchPad
     */
    public function onLaunch(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        $block = $player->getWorld()->getBlock($player->getPosition()->floor()->subtract(0, 1, 0));
        $config = Main::getInstance()->getConfig();
        $launch_block = $config->getNested('launchpad.block');
        $strength = $config->getNested('launchpad.launch_power');
        $height = $config->getNested('launchpad.launch_power_y');
        if($config->getNested('launchpad.enabled', true)) {
            if ($block->getName() == $launch_block) {
                $direction = $player->getDirectionPlane()->normalize()->multiply($strength);
                $player->setMotion(new Vector3($direction->getX(), $height, $direction->getY()));
            }
        }
    }

    /*
     * DoubleJump
     */
    public function onJump(PlayerJumpEvent $event)
    {
        $player = $event->getPlayer();
        $config = Main::getInstance()->getConfig();
        $height = $config->getNested('double_jump.launch_power_y');
        if($config->getNested('double_jump.enabled', true)) {
            $player->setMotion(new Vector3(0, $height, 0));
        }

    }
}