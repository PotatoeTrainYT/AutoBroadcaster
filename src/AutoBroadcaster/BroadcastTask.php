<?php

declare(strict_types=1);

namespace AutoBroadcaster;

use pocketmine\scheduler\PluginTask;

class BroadcastTask extends PluginTask {

	private $plugin;

	public function __construct(Main $main){
		$this->main = $main;
		parent::__construct($main);
	}

	public function onRun(int $currentTick) {
      $settings = $this->main->settings;
      $messages = $this->main->settings->get("messages");
      $messages = $messages[array_rand($messages)];
      $message = "$messages";
      $message = str_replace("{MAXPLAYERS}", $this->main->getServer()->getMaxPlayers(), $message);
      $message = str_replace("{ONLINE}", count($this->main->getServer()->getOnlinePlayers()), $message);
      $this->main->getServer()->broadcastMessage($message);
	}
}

