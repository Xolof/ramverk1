
<?php
/**
 * Routes to ease testing.
 */
return [

    // All routes in order
    "routes" => [
        [
            "info" => "Validate IP address.",
            "mount" => "validate-ip-api",
            "handler" => "\Anax\Controller\ValidateIpAPIController",
        ],
    ]
];
