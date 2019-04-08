<?php

namespace JoinToolsPMMP;

use pocketmine\plugin\PluginBase as PB;
use pocketmine\event\Listener as L;
use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\level\sound\GhastShootSound;
use pocketmine\math\Vector3;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\Config;

class Main extends PB implements L{

    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML)
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("JoinToolsPMMP is now enabled!")
    }

    public function onDisable(){
        $this->getServer()->getLogger()->info("JoinToolsPMMP is now disabled!")
    }

    public function onJoin(PlayerJoinEvent $ev){
        $name = $player->getName();
        $ev->setJoinMessage("");
        $player->sendMessage($this->plugin->config->get("welcome-message"));
        $player->addTitle($this->plugin->config->get("join-title"));
        $this->getServer()->broadcastMessage($this->plugin->config->get("join-message"));
        $this->getServer()->broadcastPopup($this->plugin->config->get("join-popup"));
    }

    public function onQuit(PlayerQuitEvent $ev) {
        $name = $player->getName();
        $ev->setQuitMessage("");
        $this->getServer()->broadcastMessage($this->plugin->config->get("leave-message"));
        $this->getServer()->broadcastPopup($this->plugin->config->get("leave-popup"));
    }
}