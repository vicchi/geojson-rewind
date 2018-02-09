<?php

include "../vendor/autoload.php";

$source = [
    'type' => 'Polygon',
    'coordinates' => [
    [ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0], [100.0, 1.0], [100.0, 0.0] ],
    [ [100.2, 0.2], [100.8, 0.2], [100.8, 0.8], [100.2, 0.8], [100.2, 0.2] ]
    ]
];
$enforce_rfc7946=true;
$output = Vicchi\GeoJson\Rewind::rewind($source, $enforce_rfc7946);

// show output for demonstration purposes
var_dump($output);

?>
