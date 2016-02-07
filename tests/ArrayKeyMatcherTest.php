<?php

namespace DanHanly\Scientist\UtilityMatchers\Tests;

use DanHanly\Scientist\UtilityMatchers\ArrayKeyMatcher;

class ArrayKeyMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testNoKeys()
    {
        $matcher = new ArrayKeyMatcher();
        $this->assertFalse($matcher->match([], []));
    }

    public function testInvalidKeys()
    {
        $matcher = new ArrayKeyMatcher();
        $matcher->setKeys(new \stdClass());
        $this->assertFalse($matcher->match([], []));

        $matcher->setKeys([new \stdClass()]);
        $this->assertFalse($matcher->match([], []));
    }

    public function testInvalidKeysViaConstructor()
    {
        $matcher = new ArrayKeyMatcher(new \stdClass());
        $this->assertFalse($matcher->match([], []));

        $matcher = new ArrayKeyMatcher([new \stdClass()]);
        $this->assertFalse($matcher->match([], []));
    }

    public function testStringProperty()
    {
        $control = [];
        $control['key'] = 'test';

        $trial = [];
        $trial['key'] = 'test';

        $matcher = new ArrayKeyMatcher();
        $matcher->setKeys('key');

        $this->assertTrue($matcher->match($control, $trial));

        $trial['key'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testStringPropertyViaConstructor()
    {
        $control = [];
        $control['key'] = 'test';

        $trial = [];
        $trial['key'] = 'test';

        $matcher = new ArrayKeyMatcher('key');

        $this->assertTrue($matcher->match($control, $trial));

        $trial['key'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testArrayProperties()
    {
        $control = [];
        $control['property'] = 'test';
        $control['property2'] = 'test';

        $trial = [];
        $trial['property'] = 'test';
        $trial['property2'] = 'test';

        $matcher = new ArrayKeyMatcher();
        $matcher->setKeys(
            [
                'property',
                'property2'
            ]
        );

        $this->assertTrue($matcher->match($control, $trial));

        $trial['property'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));

        $trial['property2'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testArrayPropertiesViaConstructor()
    {
        $control = [];
        $control['property'] = 'test';
        $control['property2'] = 'test';

        $trial = [];
        $trial['property'] = 'test';
        $trial['property2'] = 'test';

        $matcher = new ArrayKeyMatcher(
            [
                'property',
                'property2'
            ]
        );

        $this->assertTrue($matcher->match($control, $trial));

        $trial['property'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));

        $trial['property2'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }
}
