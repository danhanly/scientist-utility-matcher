<?php

namespace DanHanly\Scientist\UtilityMatchers;

use Scientist\Matchers\Matcher;

/**
 * Class ObjectPropertyMatcher
 * @package DanHanly\Scientist\UtilityMatchers
 */
class ObjectPropertyMatcher implements Matcher
{
    /**
     * @var array $properties
     */
    protected $properties = [];

    /**
     * ObjectPropertyMatcher constructor.
     * @param null|array $properties
     */
    public function __construct($properties = null)
    {
        if (null !== $properties) {
            $this->setProperties($properties);
        }
    }

    /**
     * Determine whether two values match.
     *
     * @param mixed $control
     * @param mixed $trial
     *
     * @return bool
     */
    public function match($control, $trial)
    {
        $properties = $this->getProperties();
        if (null === $properties) {
            return false;
        }

        foreach ($properties as $property) {
            if ($control->{$property} !== $trial->{$property}) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array|string $properties
     *
     * @return void
     */
    public function setProperties($properties)
    {
        if (true === is_string($properties)) {
            $this->properties[] = $properties;
            return;
        }

        if (true === is_array($properties)) {
            foreach ($properties as $property) {
                // Only add if the property name is a string
                if (is_string($property)) {
                    $this->properties[] = $property;
                }
            }
            return;
        }
    }

    /**
     * @return array|null
     */
    public function getProperties()
    {
        if (true === empty($this->properties)) {
            return null;
        }

        return $this->properties;
    }
}
