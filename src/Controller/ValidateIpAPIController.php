<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\IpValidator\IpValidator;

/**
 * A controller for validating an IP-adress.
 */
class ValidateIpAPIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexActionPost() : array
    {
        $request = $this->di->request;

        $input = htmlentities($request->getPost("ip"));
        $data = [];
        $item = [];

        $validator = new IpValidator;

        // Check if IP is valid
        $ipType = $validator->validateIp($input);

        if ($ipType) {
            // Check if there's a domain name connected to the IP-address
            $hostName = gethostbyaddr($input);

            $item[] = ["ip" => $input];
            $item[] = ["valid" => true];
            $item[] = ["type" => $ipType];

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
