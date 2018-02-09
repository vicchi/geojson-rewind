<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vicchi\GeoJson\Rewind;

final class RewindTest extends TestCase {
    public function testFeatureGood(): void {
        $input = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/featuregood.input.geojson');
        $expected = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/featuregood.output.geojson');
        $actual = Rewind::rewind($input);
        $this->assertEquals($expected, $actual);
    }

    public function testCollection(): void {
        $input = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/collection.input.geojson');
        $expected = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/collection.output.geojson');
        $actual = Rewind::rewind($input);
        $this->assertEquals($expected, $actual);
    }

    public function testFlip(): void {
        $input = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/flip.input.geojson');
        $expected = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/flip.output.geojson');
        $actual = Rewind::rewind($input);
        $this->assertEquals($expected, $actual);
    }

    public function testMultiPolygon(): void {
        $input = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/multipolygon.input.geojson');
        $expected = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/multipolygon.output.geojson');
        $actual = Rewind::rewind($input);
        $this->assertEquals($expected, $actual);
    }

    public function testReverse(): void {
        $input = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/rev.input.geojson');
        $expected = $this->getTestData(dirname(__FILE__) . '/../tests/rewind/rev.output.geojson');
        $actual = Rewind::rewind($input);
        $this->assertEquals($expected, $actual);
    }

    private function getTestData($file) {
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
