<?php
/**
 * Configuration file for database service.
 */
return [
    // Services to add to the container.
    "services" => [
        "api-key" => [
            "shared" => true,
            "callback" => function () {
                $keyHolder = new \Anax\KeyHolder\KeyHolder();

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("api-key.php");

                $key = $config["config"]["api-key"];

                $keyHolder->setKey($key);

                return $keyHolder;
            }
        ],
    ],
];
