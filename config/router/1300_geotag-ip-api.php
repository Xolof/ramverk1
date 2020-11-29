<?php
/**
 * Routes to ease testing.
 */
return [

    // All routes in order
    "routes" => [
        [
            "info" => "Get weather forecast or history.",
            "mount" => "geotag-ip-api",
            "handler" => "\Anax\Controller\GeoTagIpAPIController",
        ],
    ]
];
