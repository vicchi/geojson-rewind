<?php

namespace Vicchi\GeoJson;

class Rewind {
    static public function rewind($geojson, $enforce_rfc7946=true) {
        switch ($geojson['type']) {
            case 'FeatureCollection':
                $geojson['features'] = array_map(function($item) use($enforce_rfc7946) {
                    return self::rewind($item, $enforce_rfc7946);
                }, $geojson['features']);
                return $geojson;

            case 'Feature':
                $geojson['geometry'] = self::rewind($geojson['geometry'], $enforce_rfc7946);
                return $geojson;

            case 'Polygon':
            case 'MultiPolygon':
                return self::correct($geojson, $enforce_rfc7946);

            default:
                return $geojson;
        }
    }

    static private function correct($feature, $enforce_rfc7946) {
        if ($feature['type'] === 'Polygon') {
            $feature['coordinates'] = self::correctRings($feature['coordinates'], $enforce_rfc7946);
        }

        else if ($feature['type'] === 'MultiPolygon') {
            $feature['coordinates'] = array_map(function($item) use($enforce_rfc7946) {
                return self::correctRings($item, $enforce_rfc7946);
            }, $feature['coordinates']);
        }

        return $feature;
    }

    static private function correctRings($coords, $enforce_rfc7946) {
        $enforce_rfc7946 = boolval($enforce_rfc7946);
        $coords[0] = self::wind($coords[0], !$enforce_rfc7946);
        for ($i = 1; $i < count($coords); $i++) {
            $coords[$i] = self::wind($coords[$i], $enforce_rfc7946);
        }

        return $coords;
    }

    static private function wind($coords, $dir) {
        return self::clockwise($coords) === $dir ? $coords : array_reverse($coords);
    }

    static private function clockwise($coords) {
        return (Area::ringArea($coords) >= 0);
    }
}

?>
