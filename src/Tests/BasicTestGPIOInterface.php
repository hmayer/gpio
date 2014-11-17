<?php
namespace WaffleSystems\GPIO\Tests;

use \WaffleSystems\GPIO\GPIOInterface;

class BasicTestGPIOInterface implements GPIOInterface
{

    private $pins = [];

    private function doesPinExist($number)
    {
        return isset($this->pins[$number]);
    }

    public function enablePin($number)
    {
        if (!$this->doesPinExist($number)) {
            $this->pins[$number] = [
                    'direction' => null,
                    'value' => null
                ];
        }
        echo "Enable Pin : [$number]\n";
    }

    public function disablePin($number)
    {
        unset($this->pins[$number]);
        echo "Disable Pin : [$number]\n";
    }

    public function isPinEnabled($number)
    {
        echo "Return Is Pin Enabled : [$number]\n";
        return $this->doesPinExist($number);
    }

    public function getPinDirection($number)
    {
        echo "Return Pin Direction : [$number]\n";
        return $this->doesPinExist($number) ? $this->pins[$number]['direction'] : null;
    }

    public function setPinDirection($number, $direction)
    {
        echo "Set Pin Direction : [$number], [$direction]\n";
        return $this->setDataOfPin($number, 'direction', $direction);
    }

    public function getPinValue($number)
    {
        echo "Return Pin Value : [$number]\n";
        return $this->doesPinExist($number) ? $this->pins[$number]['value'] : null;
    }

    public function setPinValue($number, $value)
    {
        echo "Set Pin Value : [$number], [$value]\n";
        return $this->setDataOfPin($number, 'value', $value);
    }

    /**
     * @param string $key
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

