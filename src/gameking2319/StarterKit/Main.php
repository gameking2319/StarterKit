<?php

declare(strict_types=1);

namespace gameking2319\StarterKit;

use pocketmine\item\ItemIds;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

    /** @var Main */
    private static $instance;

    /** @var \SQLite3 */
    private static $database;

    /** @var Config */
    private static $config;

    public function onEnable()
    {
        /** @var \SQLite3 */
        self::$database = new \SQLite3($this->getDataFolder() . "database.db");

        // Set the instance to $this
        self::$instance = $this;

        // Create the config
        self::$config = new Config($this->getDataFolder() . 'config.yml', Config::YAML, [
            "starterKit"=>[
                ItemIds::STEAK => 10
            ]
        ]);

        // Create the main table
        self::$database->query("CREATE TABLE IF NOT EXISTS players(id INTEGER PRIMARY KEY AUTOINCREMENT, player TEXT);");

    }

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return self::$config;
    }

    /**
     * @return \SQLite3
     */
    public static function getDatabase(): \SQLite3
    {
        return self::$database;
    }

}
