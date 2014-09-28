<?php
namespace WaffleSystems\GPIO;

class RaspberryPiGPIOInterface implements GPIOInterface
{

    private $gpioDirectory = '/sys/class/gpio';
    private $dryRunTesting;

    public function setTestingEnabled($enabled)
    {
        $this->dryRunTesting = $enabled;
    }

    private function putIntoFile($file, $value)
    {
        $file = "{$this->gpioDirectory}/$file";
        if ($this->dryRunTesting) {
            echo "$file = $value\n";
            return;
        }
        file_put_contents($file, $value);
    }

    private function getFromFile($file)
    {
        $path = "{$this->gpioDirectory}/$file";
        if ($this->dryRunTesting) {
            echo "$path\n";
            return null;
        }
        return file_get_contents($path);
    }

    public function enablePin($number)
    {
        $this->putIntoFile('export', $number);
    }

    public function disablePin($number)
    {
        $this->putIntoFile('unexport', $number);
    }

    public function isPinEnabled($number)
    {
        return is_dir("{$this->gpioDirectory}/gpio$number");
    }

    public function getPinDirection($number)
    {
        return $this->getFromFile("gpio$number/direction");
    }

    public function setPinDirection($number, $direction)
    {
        $this->putIntoFile("gpio$number/direction", $direction);
    }

    public function getPinValue($number)
    {
        return $this->getFromFile("gpio$number/value");
    }

    public function setPinValue($number, $value)
    {
        $this->putIntoFile("gpio$number/value", $value);
    }

}
