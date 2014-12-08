<?php
namespace WaffleSystems\GPIO;

class RaspberryPiGPIOInterface implements GPIOInterface
{

    private $useBcm;
    private $dryRunTesting;
    private $commandPrefix;

    public function useBcm($value)
    {
        $this->useBcm = $value;
    }

    public function setCommandPrefix($prefix)
    {
        $this->commandPrefix = $prefix;
    }

    public function setTesting($enabled)
    {
        $this->dryRunTesting = $enabled;
    }

    private function executeGpio($command)
    {
        $fullCommand = $this->commandPrefix . 'gpio ';
        if ($this->useBcm) {
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
        $this->executeGpio('mode ' . escapeshellarg($number) . ' ' . escapeshellarg($direction));
    }

    public function writeToPin($number, $value)
    {
        $this->executeGpio('write ' . escapeshellarg($number) . ' ' . escapeshellarg($value));
    }

    public function destroyPin($number)
    {
        $this->executeGpio('unexport ' . escapeshellarg($number));
    }

    public function readFromPin($number)
    {
        return (int) $this->executeGpio('read ' . escapeshellarg($number));
    }
}
