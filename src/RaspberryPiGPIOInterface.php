<?php
namespace WaffleSystems\GPIO;

class RaspberryPiGPIOInterface implements GPIOInterface
{

    private $gpioDirectory = '/sys/class/gpio';
    private $useBCM;
    private $dryRunTesting;
    private $commandPrefix;

    public function useBCM($value)
    {
        $this->useBCM = $value;
    }

    public function setCommandPrefix($prefix)
    {
        $this->commandPrefix = $prefix;
    }

    public function setTesting($enabled)
    {
        $this->dryRunTesting = $enabled;
    }

    private function executeGPIO($command)
    {
        $fullCommand = $this->commandPrefix . 'gpio ';
        if ($this->useBCM) {
            $fullCommand .= '-g ';
        }
        $fullCommand .= $command;
        if ($this->dryRunTesting) {
            echo $fullCommand, "\n";
            return;
        }
        $output = shell_exec($fullCommand);
        return $output;
    }

    public function setupPin($number, $direction)
    {
        $this->executeGPIO('mode ' . escapeshellarg($number) . ' ' . escapeshellarg($direction));
    }

    public function writeToPin($number, $value)
    {
        $this->executeGPIO('write ' . escapeshellarg($number) . ' ' . escapeshellarg($value));
    }

    public function destroyPin($number)
    {
        $this->executeGPIO('unexport ' . escapeshellarg($number));
    }

    public function readFromPin($number)
    {
        return (int) $this->executeGPIO('read ' . escapeshellarg($number));
    }
}
