<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\IpValidator\IpValidator;
use Anax\IpGeoTagger\IpGeoTagger;

/**
 * Controller for geo-tagging in IP adress.
 */
class GeoTagIpAPIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexActionPost() : array
    {
        $request = $this->di->request;

        $input = htmlentities($request->getPost("ip"));
        $data = [];
        $item = [];

        $validator = new IpValidator();

        // Check if IP is valid
        $ipType = $validator->validateIp($input);

        if ($ipType) {
            // Locate the ip-adress using Ipstack.
            $keyHolder = $this->di->get("geotag-key");

            $geoTagger = new IpGeoTagger($keyHolder, "http://api.ipstack.com");

            $ipInfo = $geoTagger->geoTagIp($input);

            // Check if there's a domain name connected to the IP-address
            $hostName = gethostbyaddr($input);

            $item["ip"] = $input;
            $item["valid"] = true;
            $item["type"] = $ipType;

            if ($hostName) {
                $item["hostname"] = $hostName;
            }
            $item["latitude"] = $ipInfo->latitude;
            $item["longitude"] = $ipInfo->longitude;
            $item["country_name"] = $ipInfo->country_name;
            $item["country_flag_emoji"] = $ipInfo->location->country_flag_emoji;
            $item["region_name"] = $ipInfo->region_name;
            $item["region_name"] = $ipInfo->region_name;
            $item["city"] = $ipInfo->city;

            $data[] = $item;

            return [$data, 200];
        }

        $item["ip"] = $input;
        $item["valid"] = false;
        $data[] = $item;

        return [$data, 404];
    }
}
