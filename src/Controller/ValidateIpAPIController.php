<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A test controller to show off using a model.
 */
class ValidateIpAPIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    private function validateIp($ipAdress)
    {
        if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "IPv6";
        };

        if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "IPv4";
        };

        return false;
    }


    public function indexActionPost() : array
    {
        $request = $this->di->request;

        $input = htmlentities($request->getPost("ip"));
        $data = [];
        $item = [];

        // Check if IP is valid
        $ipType = $this->validateIp($input);

        if ($ipType) {
            // Check if there's a domain name connected to the IP-address
            $hostName = gethostbyaddr($input);

            $item[] = ["ip" => $input];
            $item[] = ["valid" => true];
            $item[] = ["type" => $ipType];
            $item[] = ["valid" => true];

            if ($hostName) {
                $item[] = ["hostname" => $hostName];
            }

            $data[] = $item;

            return [$data, 200];
        }

        $item[] = ["ip" => $input];
        $item[] = ["valid" => false];
        $data[] = $item;

        return [$data, 404];
    }
}
