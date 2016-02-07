<?php

namespace DanHanly\Scientist\UtilityMatchers;

use Scientist\Matchers\Matcher;

class ArrayKeyMatcher implements Matcher
{
    protected $keys = [];

    /**
     * ArrayKeyMatcher constructor.
     * @param null|array $keys
     */
    public function __construct($keys = null)
    {
        if (null !== $keys) {
            $this->setKeys($keys);
        }
    }

    /**
     * Determine whether two values match.
     *
     * @param mixed $control
     * @param mixed $trial
     *
     * @return boolean
     */
    public function match($control, $trial)
    {
        $keys = $this->getKeys();
        if (null === $keys) {
            return false;
        }

        foreach ($keys as $key) {
            if ($control[$key] !== $trial[$key]) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array|string $keys
     *
     * @return void
     */
    public function setKeys($keys)
    {
        if (true === is_string($keys)) {
            $this->keys[] = $keys;
            return;
        }

        if (true === is_array($keys)) {
            foreach ($keys as $key) {
                // Only add if the property name is a string
                if (is_string($key)) {
                    $this->keys[] = $key;
                }
            }
            return;
        }
    }

    /**
     * @return array|null
     */
    public function getKeys()
    {
        if (true === empty($this->keys)) {
            return null;
        }

        return $this->keys;
    }
}
