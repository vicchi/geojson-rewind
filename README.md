[![Build Status](https://travis-ci.org/vicchi/geojson-rewind.svg?branch=master)](https://travis-ci.org/vicchi/geojson-rewind)

# geojson-rewind

A set of PHP helper classes to assist in generating GeoJSON geometries that are
compliant with the [GeoJSON specification](https://tools.ietf.org/html/rfc7946).

Polygon ring order was undefined in the original GeoJSON spec, but since RFC7946 the _[right hand rule](https://tools.ietf.org/html/rfc7946#section-3.1.6)_ is mandated.

> A linear ring MUST follow the right-hand rule with respect to the area it bounds, i.e., exterior rings are counterclockwise, and holes are clockwise.

(If you know British English rather than American English, simply substitute _anticlockwise_ for _counterclockwise_.)

## Acknowledgements

`geojson-rewind` is a port to PHP of Mapbox's Node.JS [`geojson-rewind`](https://github.com/mapbox/geojson-rewind) module by [Tom McWright](https://github.com/tmcw) et al. Full credits, kudos and acknowledgements are due to Tom and the rest of the [Mapbox](https://www.mapbox.com/) team.

## Install
The easiest way to install `geojson-rewind` is by using [composer](https://getcomposer.org/):

```
$> composer require vicchi/geojson-rewind
```

## Usage

```php
<?php

include "vendor/autoload.php";

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
```

The output could look like this (`$>` is the command line prompt).

```
$> php test.php
array(2) {
  ["type"]=>
  string(7) "Polygon"
  ["coordinates"]=>
  array(2) {
    [0]=>
    array(5) {
      [0]=>
      array(2) {
        [0]=>
        float(100)
        [1]=>
        float(0)
      }
      [1]=>
      array(2) {
        [0]=>
        float(101)
        [1]=>
        float(0)
      }
      [2]=>
      array(2) {
        [0]=>
        float(101)
        [1]=>
        float(1)
      }
      [3]=>
      array(2) {
        [0]=>
        float(100)
        [1]=>
        float(1)
      }
      [4]=>
      array(2) {
        [0]=>
        float(100)
        [1]=>
        float(0)
      }
    }
    [1]=>
    array(5) {
      [0]=>
      array(2) {
        [0]=>
        float(100.2)
        [1]=>
        float(0.2)
      }
      [1]=>
      array(2) {
        [0]=>
        float(100.2)
        [1]=>
        float(0.8)
      }
      [2]=>
      array(2) {
        [0]=>
        float(100.8)
        [1]=>
        float(0.8)
      }
      [3]=>
      array(2) {
        [0]=>
        float(100.8)
        [1]=>
        float(0.2)
      }
      [4]=>
      array(2) {
        [0]=>
        float(100.2)
        [1]=>
        float(0.2)
      }
    }
  }
}
```

## License

`geojson-rewind` is published under the [BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause) license. See [License File](LICENSE.txt) for more information.
