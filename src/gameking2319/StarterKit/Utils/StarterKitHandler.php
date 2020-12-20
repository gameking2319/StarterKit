<?php

namespace gameking2319\StarterKit\Utils;

use gameking2319\StarterKit\Main;
use pocketmine\Player;

class StarterKitHandler
{

    /**
     * @param Player $player
     * @param callable $func
     *
     * This method lets you do something if the user first joins
     */
    public static function executeFirstJoin(callable $func, Player $player)
    {
        // Get the database
        $database = Main::getDatabase();

        // Get playerName
        $playerName = $player->getName();

        // Get the player form database
        $stmt = $database->prepare("SELECT COUNT(*) AS C FROM players WHERE player = :player;");
        $stmt->bindParam("player", $playerName);

        // Get the results
        $res = $stmt->execute()->fetchArray();

        // Close the statement
        $stmt->close();

        // Look if user already exists
        if($res["C"] === 0){

            // Add player to the database
            $stmt = $database->prepare("INSERT INTO players(player) VALUES (:player);");
            $stmt->bindParam(":player", $playerName);

            // Execute the statement
            $stmt->close();

            // Close the statement
            $stmt->close();

            // Execute the function
            $func($player);
        }

    }

}