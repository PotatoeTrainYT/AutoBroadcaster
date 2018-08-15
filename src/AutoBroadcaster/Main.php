<?php

declare(strict_types=1);

namespace AutoBroadcaster;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

    public $settings;

    public function onEnable() : void{
        $this->getLogger()->info("AutoBroadcaster Enabled! Plugin by PotatoeTrainYT. Download at https://github.com/PotatoeTrainYT/AutoBroadcaster/");
        @mkdir($this->getDataFolder());
        $this->saveResource("settings.yml");
        $this->settings = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
        $this->scheduler();
    }

    public function scheduler() : void{
        if(is_numeric($this->settings->get("seconds"))){
            $this->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this), $this->settings->get("seconds") * 20);
        }else{
            $this->getLogger()->warning("Plugin disabling, Seconds is not a numeric value please edit");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }
}
