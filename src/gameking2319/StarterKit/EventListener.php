<?php


namespace gameking2319\StarterKit;


use gameking2319\StarterKit\Utils\StarterKitHandler;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\ItemFactory;
use pocketmine\Player;

class EventListener implements Listener
{

    /**
     * @param PlayerJoinEvent $e
     *
     * Gives the items to the user when he joins
     */
    public function onJoin(PlayerJoinEvent $e){
        // Get the player
        $player = $e->getPlayer();

        // Give the items to the $player
        StarterKitHandler::executeFirstJoin(function(Player $player){

            // Get the main instance
            $main = Main::getInstance();

            // Get the config
            $config = $main->getConfig()->getAll();

            // Get the config keys
            $configKeys = array_keys($config["starterKit"]);

            // Get the loop tracker
            $data = 0;
            // Loop true all the items of the starterKits
            foreach ($config["starterKit"] as $itemAmout){
                // Add the item to the player
                $player->getInventory(ItemFactory::get($configKeys[$data], 0, $itemAmout));
                // add +1 to the loopTracker
                $data++;
            }


        }, $player);
    }

}