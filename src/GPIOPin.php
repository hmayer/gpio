<?php
namespace WaffleSystems\GPIO;

class GPIOPin
{

    private $service;
    private $place;

    public function __construct($place, GPIOService $service)
    {
        $this->place = $place;
        $this->service = $service;
    }
    
    public function enable()
    {
        $this->service->getHandler()->enablePin($this->place);
    }

    public function disable()
    {
        $this->service->getHandler()->disablePin($this->place);
    }

    public function getDirection()
    {
        return $this->service->getHandler()->getPinDirection($this->place);
    }

    public function setDirection($direction)
    {
        $this->service->getHandler()->setPinDirection($this->place, $direction);
    }

    public function getValue()
    {
        return $this->service->getHandler()->getPinValue($this->place);
    }

    public function setValue($value)
    {
        $this->service->getHandler()->setPinValue($this->place, $value);
    }

}
