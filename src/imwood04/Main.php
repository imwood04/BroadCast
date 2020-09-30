<?php

namespace imwood04;

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
        $this->getLogger()->info("BroadCast Plugin Loading");
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("BroadCast Enabled!");
    }

    public function onDisable()
    {
        $this->getLogger()->info("BroadCast Disabled");
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $event->setJoinMessage("");
        $player = $event->getPlayer();
        $name = $player->getName();
        $this->getServer()->broadcastMessage(TF::GREEN . "$name Has Joined the Server!");
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $event->setQuitMessage("");
        $player = $event->getPlayer();
        $name = $player->getName();
        $this->getServer()->broadcastMessage(TF::RED . "$name Has Quit the Server!");

    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
    {
        if ($cmd->getName() === "broadcast") {
            if (!$sender->hasPermission("imwood04.bc")) {
                $sender->sendMessage(TF::RED . "No Perms!");
            } else {
                if (isset($args[0])) {
                    $msg = implode(" ", $args);
                    $this->getServer()->broadcastMessage(TF::AQUA . $msg);
                    $sender->sendMessage(TF::AQUA . "BroadCast" . $msg . "=>");
                } else {
                    $sender->sendMessage(TF::RED . "Usage: /broadcast {Your Message}, /bc {Your Message}");
                }
            }
        }
        return true;
    }
}
