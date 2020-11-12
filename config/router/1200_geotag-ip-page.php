<?php
/**
 * Routes to ease testing.
 */
return [

    // All routes in order
    "routes" => [
        [
            "info" => "Validate IP address.",
            "mount" => "geotag-ip-page",
            "handler" => "\Anax\Controller\GeoTagIpPageController",
        ],
    ]
];
