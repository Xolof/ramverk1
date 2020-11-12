<?php

namespace Anax\View;

/**
 * A form for the validate IP page and API.
 */

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}

?><article <?= classList($classes) ?>>
    <h2>Geotagga Ip-address</h2>

    <form action="geotag-ip-api" method="post" style="margin-bottom:1em;">
        <input type="text" name="ip" value="<?= htmlentities($data["clientsIp"]) ?>"></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <form action="geotag-ip-page/article" method="post">
        <input type="text" name="ip" value="<?= htmlentities($data["clientsIp"]) ?>"></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <h3>Hur man jobbar med JSON API:t</h3>
    <p>Skicka en POST-request till rutten "/geotag-ip-api" med nyckeln "ip" i bodyn där "ip" innehåller IP-adressen som ska valideras.</p>

    <h4>Exempel för API</h4>

    <p>Ogiltig Ip:<p>
    <form action="geotag-ip-api" method="post">
        <input type="text" value="123.invalid.ip" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <p>Giltig Ipv4:<p>
    <form action="geotag-ip-api" method="post">
        <input type="text" value="194.47.150.9" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <p>Giltig Ipv6:<p>
    <form action="geotag-ip-api" method="post">
        <input type="text" value="2400:cb00:2049:1::c629:defe" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <h4>Exempel för webbsida</h4>

    <p>Ogiltig Ip:<p>
    <form action="geotag-ip-page/article" method="post">
        <input type="text" value="123.invalid.ip" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <p>Giltig Ipv4:<p>
    <form action="geotag-ip-page/article" method="post">
        <input type="text" value="194.47.150.9" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <p>Giltig Ipv6:<p>
    <form action="geotag-ip-page/article" method="post">
        <input type="text" value="2400:cb00:2049:1::c629:defe" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>
</article>
