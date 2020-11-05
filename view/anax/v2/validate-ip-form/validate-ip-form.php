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
    <h2>Validera IP-adress</h2>

    <form action="validate-ip-api" method="post" style="margin-bottom:1em;">
        <input type="text" placeholder="ip-adress" name="ip"></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <form action="validate-ip-page/article" method="post">
        <input type="text" placeholder="ip-adress" name="ip"></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <h3>Hur man jobbar med JSON API:t</h3>
    <p>Skicka en POST-request till rutten "/validate-ip-api" med nyckeln "ip" i bodyn där "ip" innehåller IP-adressen som ska valideras.</p>

    <h4>Exempel för API</h4>

    <p>Ogiltig Ip:<p>
    <form action="validate-ip-api" method="post">
        <input type="text" value="123.invalid.ip" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <p>Giltig Ipv4:<p>
    <form action="validate-ip-api" method="post">
        <input type="text" value="194.47.150.9" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <p>Giltig Ipv6:<p>
    <form action="validate-ip-api" method="post">
        <input type="text" value="2001:0db8:85a3:0000:0000:8a2e:0370:7334" name="ip" readonly></input>
        <input type="submit" value="Få svar som JSON">
    </form>

    <h4>Exempel för webbsida</h4>

    <p>Ogiltig Ip:<p>
    <form action="validate-ip-page/article" method="post">
        <input type="text" value="123.invalid.ip" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <p>Giltig Ipv4:<p>
    <form action="validate-ip-page/article" method="post">
        <input type="text" value="194.47.150.9" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>

    <p>Giltig Ipv6:<p>
    <form action="validate-ip-page/article" method="post">
        <input type="text" value="2001:0db8:85a3:0000:0000:8a2e:0370:7334" name="ip" readonly></input>
        <input type="submit" value="Få svar som HTML">
    </form>
</article>
