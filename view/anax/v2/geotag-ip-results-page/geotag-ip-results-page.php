<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}

?><article <?= classList($classes) ?>>
<?php
if (property_exists($content, "ip")) {
    echo "<h2>Resultat för IP-address {$content->ip}</h2>";

    if (property_exists($content, "host_name")) {
        echo "<p>Host name: {$content->host_name}</p>";
    }

    echo <<<EOD
<p>Typ: {$content->type}</p>
<p>Latitud: {$content->latitude}</p>
<p>Longitud: {$content->longitude}</p>
<p>Land: {$content->country_name} {$content->location->country_flag_emoji}</p>
<p>Region: {$content->region_name}</p>
<p>Närmsta större stad: {$content->city}</p>
EOD;
} else {
    echo "{$content->message}";
}

?>
</article>
