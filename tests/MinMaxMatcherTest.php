<?php

namespace DanHanly\Scientist\UtilityMatchers\Tests;

use DanHanly\Scientist\UtilityMatchers\MinMaxMatcher;

class MinMaxMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testMinimumValueMatching()
    {
        $matcher = new MinMaxMatcher(10);

        $control = 20;
        $trial = 25;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 10;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 9;

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testMaximumValueMatching()
    {
        $matcher = new MinMaxMatcher(null, 50);

        $control = 20;
        $trial = 25;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 50;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 51;

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testMinimumAndMaximumValueMatching()
    {
        $matcher = new MinMaxMatcher(10, 50);

        $control = 20;
        $trial = 25;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 10;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 9;

        $this->assertFalse($matcher->match($control, $trial));

        $trial = 50;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 51;

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testSetters()
    {
        $matcher = new MinMaxMatcher();

        $matcher->setMin(10);
        $matcher->setMax(50);

        $control = 20;
        $trial = 25;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 10;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 9;

        $this->assertFalse($matcher->match($control, $trial));

        $trial = 50;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 51;

        $this->assertFalse($matcher->match($control, $trial));
    }

    /**
     * @expectedException \DanHanly\Scientist\UtilityMatchers\Exception\InvalidMatchingParametersException
     */
    public function testNullParametersException()
    {
        $matcher = new MinMaxMatcher();
        $matcher->match(20, 25);
    }

    public function testDecimalMatchingValues()
    {
        $matcher = new MinMaxMatcher(10.5, 50.7);

        $control = 20;
        $trial = 25;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 10.5;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 10.49;

        $this->assertFalse($matcher->match($control, $trial));

        $trial = 50.7;

        $this->assertTrue($matcher->match($control, $trial));

        $trial = 50.71;

        $this->assertFalse($matcher->match($control, $trial));
    }
}
