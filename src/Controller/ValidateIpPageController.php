<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\IpValidator\IpValidator;

/**
* A controller for validating an IP-adress.
 */
class ValidateIpPageController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

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

        $validator = new IpValidator;

        // Check if IP is valid
        $ipType = $validator->validateIp($input);
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
