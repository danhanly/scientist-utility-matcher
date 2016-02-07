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
            // Deal With Deep Keys
            if (false !== strpos($key, '->')) {
                $subkeys = explode('->', $key);

                $controlValue = $this->getValueForSubkeys($control, $subkeys);
                $trialValue = $this->getValueForSubkeys($trial, $subkeys);

                if ($controlValue === false || $trialValue === false) {
                    return false;
                }

                if ($controlValue !== $trialValue) {
                    return false;
                }

                continue;
            }
            // Simple Keys
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

                if (is_string($key)) {
                    $this->keys[] = $key;
                }

                if (is_array($key)) {
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

    /**
     * @param array $base
     * @param array $subkeys
     *
     * @return mixed
     */
    private function getValueForSubkeys($base, $subkeys)
    {
        foreach ($subkeys as $key) {
            $base = $base[$key];
        }

        return $base;
    }
}
