<?php

namespace DanHanly\Scientist\UtilityMatchers;

use Scientist\Matchers\Matcher;
use DanHanly\Scientist\UtilityMatchers\Exception\InvalidMatchingParametersException;

/**
 * Class MinMaxMatcher
 * @package DanHanly\Scientist\UtilityMatchers
 */
class MinMaxMatcher implements Matcher
{
    /**
     * @var integer|null $min
     */
    protected $min = null;

    /**
     * @var integer|null $max
     */
    protected $max = null;

    /**
     * MinMaxMatcher constructor.
     * @param null|integer $min
     * @param null|integer $max
     */
    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Determine whether two values match.
     *
     * @param mixed $control
     * @param mixed $trial
     *
     * @return bool
     *
     * @throws InvalidMatchingParametersException
     */
    public function match($control, $trial)
    {
        if (null !== $this->min) {
            if ($control < $this->min || $trial < $this->min) {
                return false;
            }
        }

        if (null !== $this->max) {
            if ($control > $this->max || $trial > $this->max) {
                return false;
            }
        }

        if (null === $this->min && null === $this->max) {
            throw new InvalidMatchingParametersException;
        }

        return true;
    }

    /**
     * @param int|null $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @param int|null $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }
}
