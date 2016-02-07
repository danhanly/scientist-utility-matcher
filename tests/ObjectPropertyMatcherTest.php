<?php

namespace DanHanly\Scientist\UtilityMatchers\Tests;

use DanHanly\Scientist\UtilityMatchers\ObjectPropertyMatcher;

class ObjectPropertyMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testNoProperties()
    {
        $matcher = new ObjectPropertyMatcher();
        $this->assertFalse($matcher->match(new \stdClass(), new \stdClass()));
    }

    public function testInvalidProperties()
    {
        $matcher = new ObjectPropertyMatcher();
        $matcher->setProperties(new \stdClass());
        $this->assertFalse($matcher->match(new \stdClass(), new \stdClass()));

        $matcher->setProperties([new \stdClass()]);
        $this->assertFalse($matcher->match(new \stdClass(), new \stdClass()));
    }

    public function testInvalidPropertiesViaConstructor()
    {
        $matcher = new ObjectPropertyMatcher(new \stdClass());
        $this->assertFalse($matcher->match(new \stdClass(), new \stdClass()));

        $matcher = new ObjectPropertyMatcher([new \stdClass()]);
        $this->assertFalse($matcher->match(new \stdClass(), new \stdClass()));
    }

    public function testStringProperty()
    {
        $control = new \stdClass();
        $control->property = 'test';

        $trial = new \stdClass();
        $trial->property = 'test';

        $matcher = new ObjectPropertyMatcher();
        $matcher->setProperties('property');

        $this->assertTrue($matcher->match($control, $trial));

        $trial->property = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testStringPropertyViaConstructor()
    {
        $control = new \stdClass();
        $control->property = 'test';

        $trial = new \stdClass();
        $trial->property = 'test';

        $matcher = new ObjectPropertyMatcher('property');

        $this->assertTrue($matcher->match($control, $trial));

        $trial->property = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testArrayProperties()
    {
        $control = new \stdClass();
        $control->property = 'test';
        $control->property2 = 'test';

        $trial = new \stdClass();
        $trial->property = 'test';
        $trial->property2 = 'test';

        $matcher = new ObjectPropertyMatcher();
        $matcher->setProperties(
            [
                'property',
                'property2'
            ]
        );

        $this->assertTrue($matcher->match($control, $trial));

        $trial->property = 'different';

        $this->assertFalse($matcher->match($control, $trial));

        $trial->property2 = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }

    public function testArrayPropertiesViaConstructor()
    {
        $control = new \stdClass();
        $control->property = 'test';
        $control->property2 = 'test';

        $trial = new \stdClass();
        $trial->property = 'test';
        $trial->property2 = 'test';

        $matcher = new ObjectPropertyMatcher(
            [
                'property',
                'property2'
            ]
        );

        $this->assertTrue($matcher->match($control, $trial));

        $trial->property = 'different';

        $this->assertFalse($matcher->match($control, $trial));

        $trial->property2 = 'different';

        $this->assertFalse($matcher->match($control, $trial));
    }
}
