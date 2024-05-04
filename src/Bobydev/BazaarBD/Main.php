<?php

namespace Bobydev\BazaarBD;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("bazaarBD made by Bobydev enabled!");
    }

   public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
    if ($command->getName() === "bazaarbd") {
        if ($sender instanceof Player) {
            if ($sender->hasPermission("bazaarbd.command")) {
                $this->openBazaarForm($sender);
            } else {
                $sender->sendMessage("You don't have permission to use this command.");
            }
            return true;
        }
        $sender->sendMessage("This command can only be used in-game.");
        return false;
    }
    return false;
}
    public function openBazaarForm(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if($data === null) {
                return;
            }
            switch($data) {
                case 0:
              $this->getServer()->dispatchCommand($player, "sell all");
                    break;
                case 1:
               $this->getServer()->dispatchCommand($player, "sell hand");
                    break;
                case 2:
              $this->getServer()->dispatchCommand($player, "sell ores"); 
                    break;
            }
        });

        $form->setTitle("BazaarBD");
        $form->addButton("Sell Inventory", 0, "textures/blocks/diamond_block.png");
        $form->addButton("Sell Hand", 0, "textures/blocks/emerald_block.png");
        $form->addButton("Sell Ores", 0, "textures/blocks/gold_block.png");
        $player->sendForm($form);
     }
   }