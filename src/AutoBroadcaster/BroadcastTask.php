<?php

declare(strict_types=1);

namespace AutoBroadcaster;

use pocketmine\scheduler\PluginTask;

class BroadcastTask extends PluginTask{

    private $main;

    public function __construct(Main $main){
        $this->main = $main;
        parent::__construct($main);
    }

    public function onRun(int $currentTick){
        $messages = $this->main->settings->get("messages");
        $messages = $messages[array_rand($messages)];
        $message = "$messages";
        $message = str_replace("&", "§", $message);
        $message = str_replace("{MAX_PLAYERS}", $this->main->getServer()->getMaxPlayers(), $message);
        $message = str_replace("{ONLINE}", count($this->main->getServer()->getOnlinePlayers()), $message);
        $this->main->getServer()->broadcastMessage($message);
    }
}

