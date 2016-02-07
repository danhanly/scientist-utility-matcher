[![Scientist](scientist.png)](https://github.com/daylerees/scientist)

# Scientist Utility Matchers

[![Packagist Version](https://img.shields.io/packagist/v/danhanly/scientist-utility-matcher.svg)](https://packagist.org/packages/danhanly/scientist-utility-matcher)
[![Packagist](https://img.shields.io/packagist/dt/danhanly/scientist-utility-matcher.svg)](https://packagist.org/packages/danhanly/scientist-utility-matcher)

Simple type, utility matchers for use with the [Scientist Library](http://github.com/daylerees/scientist)

## 1. Installation

Require the latest version of Scientist Symfony using [Composer](https://getcomposer.org/).

    composer require danhanly/scientist-utility-matcher

## 2. Matchers

There are a number of simple matchers packaged within this project, for use with your experiments.

### 2.1 ObjectPropertyMatcher

This allows you to match specific properties on objects returned with the control and trial processes.

When initialising the matcher, you can configure it to either match against a single property (via string), or multiple properties (via array)

```php
// initialise matcher
$matcher = new \DanHanly\Scientist\UtilityMatchers\ObjectPropertyMatcher;
// define property via string
$matcher->setProperties('propertyName');
// or via array
$matcher->setProperties(['propertyName', 'anotherPropertyName']);
```

You can also set properties directly via the matcher constructor.

```php
// define property via string
$matcher = new \DanHanly\Scientist\UtilityMatchers\ObjectPropertyMatcher('propertyName');
// or via array
$matcher = new \DanHanly\Scientist\UtilityMatchers\ObjectPropertyMatcher(['propertyName', 'anotherPropertyName']);
```

### 2.2 ArrayKeyMatcher

This allows you to match specific keys on arrays returned with the control and trial processes.

#### 2.2.1 Simple Key Matching

When initialising the matcher, you can configure it to either match against a single key (via string), or multiple keys (via array)

```php
// initialise matcher
$matcher = new \DanHanly\Scientist\UtilityMatchers\ArrayKeyMatcher;
// define keys via string
$matcher->setKeys('keyName');
// or via array
$matcher->setKeys(['keyName', 'anotherKeyName']);
```

You can also set keys directly via the matcher constructor.

```php
// define key via string
$matcher = new \DanHanly\Scientist\UtilityMatchers\ArrayKeyMatcher('keyName');
// or via array
$matcher = new \DanHanly\Scientist\UtilityMatchers\ArrayKeyMatcher(['keyName', 'anotherKeyName']);
```

#### 2.2.2 Deep Key Matching

Array deep key matching can be done with the `->` delimiter.

Say for example you wanted to match the zip code of an address, but the address is stored in `$array['data']['user']['address']['zip']`, your matching notation would be `data->user->address->zip`

```php
// define key via string
$matcher = new \DanHanly\Scientist\UtilityMatchers\ArrayKeyMatcher('data->user->address->zip');
```

## 3. Usage

Once you've initialised and configured your matcher, you can use it within your experiments.

```php
$experiment = (new Scientist\Laboratory)
  ->experiment('experiment title')
  ->control($controlCallback)
  ->trial('trial name', $trialCallback)
  ->matcher($matcher);
```
