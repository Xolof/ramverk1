<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A test controller to show off using a model.
 */
class ValidateIpPageController implements ContainerInjectableInterface
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

    public function indexAction()
    {
        $page = $this->di->get("page");
        $page->add("anax/v2/validate-ip-form/validate-ip-form");
        return $page->render([
            "title" => "Validate IP",
        ]);
    }

    public function articleActionPost() : object
    {
        $input = htmlentities($this->di->request->getPost("ip"));
        $data = ["content" => "<h2>Result</h2>"];

        // Check if IP is valid
        $ipType = $this->validateIp($input);
        if ($ipType) {
            // Check if there's a domain name connected to the IP-address
            $hostName = gethostbyaddr($input) ?? "-";

            $data["content"] .= "<p>The ip $input is a valid $ipType address.</p><p>Host name: $hostName</p>";
        } else {
            $data["content"] .= "<p>The ip $input is invalid.</p>";
        }

        // Send response as HTML
        $page = $this->di->get("page");
        $page->add("anax/v2/article/default", $data);
        return $page->render([
            "title" => "Result for IP",
        ]);
    }
}
