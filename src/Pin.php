<?php
namespace WaffleSystems\GPIO;

class Pin
{

    private $service;
    private $place;
    private $direction;

    public function __construct($place, GPIOService $service, $direction)
    {
        $this->place     = $place;
        $this->service   = $service;
        $this->direction = $direction;
    }

    /**
     * @return boolean
     */
    public function isOn()
    {
        return 1 === $this->service->getHandler()->readFromPin($this->place);
    }

    public function turnOn()
    {
        $this->service->getHandler()->writeToPin($this->place, 1);
    }

    public function turnOff()
    {
        $this->service->getHandler()->writeToPin($this->place, 0);
    }

    public function destroy()
    {
        $this->service->getHandler()->destroyPin($this->place);
    }
}
