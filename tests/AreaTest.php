<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vicchi\GeoJson\Area;

final class AreaTest extends TestCase {
    protected static $all;
    protected static $illinois;

    public static function setUpBeforeClass() {
        self::$all = self::getTestData(dirname(__FILE__) . '/../tests/area/all.geojson');
        self::$illinois = self::getTestData(dirname(__FILE__) . '/../tests/area/illinois.geojson');
    }

    public function testIllinoisArea(): void {
        $this->assertEquals(145978332359.36716, Area::geometry(self::$illinois));
    }

    public function testWorldArea(): void {
        $this->assertEquals(511207893395811.06, Area::geometry(self::$all));
    }

    public function testZeroPoint(): void {
        $data = [
            'type' => 'Point',
            'coordinates' => [0, 0]
        ];
        $this->assertEquals(0, Area::geometry($data));
    }

    public function testZeroLineString(): void {
        $data = [
            'type' => 'LineString',
            'coordinates' => [
                [0, 0],
                [1, 1]
            ]
        ];
        $this->assertEquals(0, Area::geometry($data));
    }

    public function testGeometryCollection(): void {
        $data = [
            'type' => 'GeometryCollection',
            'geometries' => [self::$all, self::$illinois]
        ];
        $this->assertEquals(511353871728170.44, Area::geometry($data));
    }

    private static function getTestData($file) {
        $data = file_get_contents($file);
        if ($data === false) {
            throw new \Exception(sprintf("Failed to read %s\n", $file));
        }

        $geojson = json_decode($data, true);
        if ($geojson === null) {
            throw new \Exception(sprintf("Failed to JSON-ify %s (%s)\n", $file, json_last_error_msg()));
        }
        return $geojson;
    }
}

?>
