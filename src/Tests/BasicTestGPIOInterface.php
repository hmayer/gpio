<?php
namespace WaffleSystems\GPIO\Tests;

use \WaffleSystems\GPIO\GPIOInterface;

class BasicTestGPIOInterface implements GPIOInterface
{

    private $pins = [];

    /**
     * @param int $number
     * 
     * @return boolean
     */
    private function pinExists($number)
    {
        return isset($this->pins[$number]);
    }

    /**
     * @param int $number
     */
    public function enablePin($number)
    {
        if (!$this->doesPinExist($number)) {
            $this->pins[$number] = [
                    'direction' => null,
                    'value' => null
                ];
        }
        echo 'Enable Pin : [', $number, "]\n";
    }

    /**
     * @param int $number
     */
    public function disablePin($number)
    {
        unset($this->pins[$number]);
        echo 'Disable Pin : [', $number, "]\n";
    }

    /**
     * @param int $number
     * 
     * @return boolean
     */
    public function isPinEnabled($number)
    {
        echo 'Return Is Pin Enabled : [', $number, "]\n";
        return $this->doesPinExist($number);
    }

    /**
     * @param int $number
     * 
     * @return string
     */
    public function getPinDirection($number)
    {
        echo 'Return Pin Direction : [', $number, "]\n";
        return $this->doesPinExist($number) ? $this->pins[$number]['direction'] : null;
    }

    /**
     * @param int $number
     * @param string $direction
     */
    public function setPinDirection($number, $direction)
    {
        echo 'Set Pin Direction : [', $number, '], [', $direction, "]\n";
        return $this->setDataOfPin($number, 'direction', $direction);
    }

    /**
     * @param int $number
     * 
     * @return string
     */
    public function getPinValue($number)
    {
        echo 'Return Pin Value : [', $number, "]\n";
        return $this->doesPinExist($number) ? $this->pins[$number]['value'] : null;
    }

    /**
     * @param int $number
     * @param string $value
     */
    public function setPinValue($number, $value)
    {
        echo 'Set Pin Value : [', $number, '], [', $value, "]\n";
        return $this->setDataOfPin($number, 'value', $value);
    }

    /**
     * @param int $pin
     * @param string $key
     * @param string $value
     * 
     * @return boolean
     */
    private function setDataOfPin($pin, $key, $value)
    {
        if ($this->doesPinExist($pin)) {
            $this->pins[$pin][$key] = $value;
            return true;
        }
        return false;
    }

}

