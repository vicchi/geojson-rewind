<?php

namespace Vicchi\GeoJson;

class WGS84 {
    const RADIUS = 6378137;
    const FLATTENING_DENOM = 298.257223563;
    const FLATTENING = 1 / self::FLATTENING_DENOM;
    const POLAR_RADIUS = self::RADIUS * (1 - self::FLATTENING);
}

?>
