[![Scientist](scientist.png)](https://github.com/daylerees/scientist)

# Scientist Utility Matchers

[![Packagist Version](https://img.shields.io/packagist/v/danhanly/scientist-utility-matcher.svg)](https://packagist.org/packages/danhanly/scientist-utility-matcher)
[![Packagist](https://img.shields.io/packagist/dt/danhanly/scientist-utility-matcher.svg)](https://packagist.org/packages/danhanly/scientist-utility-matcher)

Simple type, utility matchers for use with the [Scientist Library](http://github.com/daylerees/scientist)

## Installation

Require the latest version of Scientist Symfony using [Composer](https://getcomposer.org/).

    composer require danhanly/scientist-utility-matcher

## Matchers

There are a number of simple matchers packaged within this project, for use with your experiments.

### ObjectPropertyMatcher

This allows you to match specific properties on objects returned with the control and trial processes.

When initialising the matcher, you can configure it to either match against a single property (via string), or multiple properties (via array)

```php
// initialise matcher
$matcher = new \DanHanly\Scientist\UtilityMatchers\ObjectPropertyMatcher;
// define property via string
$matcher->setProperties('propertyName');
// or via array
$matcher->setProperties(['propertyName', 'anotherPropertyName']);

// plug matcher into experiment
$experiment = (new Scientist\Laboratory)
  ->experiment('experiment title')
  ->control($controlCallback)
  ->trial('trial name', $trialCallback)
  ->matcher($matcher);
```
