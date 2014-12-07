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
        $file = $this->gpioDirectory . '/' . $file;
        $command = $this->commandPrefix . 'echo ' . shell_escapearg($value) . ' > ' . shell_escapearg($file);
        if ($this->dryRunTesting) {
            echo $command, "\n";
            return;
        }
        shell_exec($command);
    }

    private function getFromFile($file)
    {
        $path = $this->gpioDirectory . '/' . $file;
        $command = $this->commandPrefix . 'cat ' . shell_escapearg($path);
        if ($this->dryRunTesting) {
            echo $command, "\n";
            return null;
        }
        shell_exec($command);
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
        return is_dir($this->gpioDirectory . '/gpio' . $number);
    }

    public function getPinDirection($number)
    {
        return $this->getFromFile('gpio' . $number . '/direction');
    }

    public function setPinDirection($number, $direction)
    {
        $this->putIntoFile('gpio' . $number . '/direction', $direction);
    }

    public function getPinValue($number)
    {
        return $this->getFromFile('gpio' . $number . '/value');
    }

    public function setPinValue($number, $value)
    {
        $this->putIntoFile('gpio' . $number . '/value', $value);
    }
}
