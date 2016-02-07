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

    public function testStringKey()
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

    public function testStringKeyViaConstructor()
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

    public function testArrayKeys()
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

    public function testArrayKeysViaConstructor()
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

    public function testDeepArrayKeyMatching()
    {
        $control = [];
        $control['first']['second'] = 'test';

        $trial = [];
        $trial['first']['second'] = 'test';

        $matcher = new ArrayKeyMatcher('first->second');

        $this->assertTrue($matcher->match($control, $trial));

        $trial['first']['second'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testDeepArrayKeyMatchingWithIndices()
    {
        $control = [];
        $control[]['key'] = 'test';

        $trial = [];
        $trial[]['key'] = 'test';

        $matcher = new ArrayKeyMatcher('0->key');

        $this->assertTrue($matcher->match($control, $trial));

        $trial[0]['key'] = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testDeepArrayKeyMatchingWithMissingKeys()
    {
        $control = [];
        $control['first']['second'] = 'test';

        $trial = [];
        $trial['first']['second'] = 'test';

        $matcher = new ArrayKeyMatcher('first->key');

        $this->assertFalse($matcher->match($control, $trial));
    }
}
