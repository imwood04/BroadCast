<?php

namespace imwood04;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
{

    public function onLoad()
    {
        $this->getLogger()->info("BroadCaster Loading");
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("BroadCaster Enabled!");
    }

    public function onDisable()
    {
        $this->getLogger()->info("BroadCaster Disabled");
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setJoinMessage(TF::GREEN . "$name Has Joined the Server!");
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setQuitMessage(TF::RED . "$name Has Quit the Server!");
    }
    //all commands in this function
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
    {
        if ($cmd->getName() === "broadcast") {
            if (!$sender->hasPermission("imwood04.bc")) {
                $sender->sendMessage(TF::RED . "No Perms!");
            } else {
                if (isset($args[0])) {
                    $msg = implode(" ", $args);
                    $this->getServer()->broadcastMessage(TF::DARK_PURPLE . TF::BOLD .  "BroadCast => ". TF::RESET . TF::AQUA . $msg);
                    $sender->sendMessage(TF::AQUA . "BroadCast was Sent!");
                } else {
                    $sender->sendMessage(TF::RED . "Usage: /broadcast, /bc {Your Message}");
                }
            }
        }
        if ($cmd->getName() === "oof") {
            if (!$sender->hasPermission("imwood04.oof")){
                $sender->sendMessage(TF::RED . "No Perms!");
            } else {
                $sender->sendMessage(TF::DARK_GREEN . "Get OOFED on...");
            }
        }
        if(!($cmd->getName()) == "fly") {
            if(!($sender instanceof Player)){
                if (!$sender->hasPermission("imwood04.fly")){
                    $sender->setAllowFlight(true);
                    $sender->sendMessage(TF::GREEN."Your flight has been enabled");
                } else {
                    $sender->setAllowFlight(false);
                    $sender->setFlying(false);
                    $sender->sendMessage(TF::RED."Your flight has been disabled!");
                }
                }
            return false;
            }
        return true;
        }
}
