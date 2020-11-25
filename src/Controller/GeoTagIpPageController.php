<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\IpValidator\IpValidator;
use Anax\IpGeoTagger\IpGeoTagger;
use Anax\IpGetter\IpGetter;
use \stdClass;

/**
* A controller for validating an IP-adress.
 */
class GeoTagIpPageController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $ipGetter = new IpGetter();
        $clientsIp = $ipGetter->getUserIP();

        $page = $this->di->get("page");
        $page->add("anax/v2/geotag-ip-form/geotag-ip-form", ["clientsIp" => $clientsIp]);
        return $page->render([
            "title" => "Geotag IP",
        ]);
    }

    public function articleActionPost() : object
    {
        $url = $this->di->get("url");

        $input = htmlentities($this->di->request->getPost("ip"));

        $validator = new IpValidator();

        // Check if IP is valid
        $ipType = $validator->validateIp($input);
        if ($ipType) {
            // Locate the ip-adress using Ipstack.
            $keyHolder = $this->di->get("geotag-key");

            $geoTagger = new IpGeoTagger($keyHolder, "http://api.ipstack.com");

            $ipInfo = $geoTagger->geoTagIp($input);

            // Check if there's a domain name connected to the IP-address
            $hostName = gethostbyaddr($input) ?? "-";

            if ($hostName != "-") {
                $ipInfo->host_name = $hostName;
            }

            $data["content"] = $ipInfo;
        } else {
            $invalidInfo = new stdClass();
            $invalidInfo->message = "<h3>Ogiltig IP-address.</h3><a href='" . $url->create("geotag-ip-page") . "'>Sök igen</a>";
            $data["content"] = $invalidInfo;
        }

        // Send response as HTML
        $page = $this->di->get("page");
        $page->add("anax/v2/geotag-ip-results-page/geotag-ip-results-page", $data);
        return $page->render([
            "title" => "Result for IP"
        ]);
    }
}
