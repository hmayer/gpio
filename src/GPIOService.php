<?php
namespace WaffleSystems\GPIO;

class GPIOService
{

    public $handler;

    public function __construct(GPIOInterface $handler)
    {
        $this->handler = $handler;
    }

    public function getPin($number)
    {
        return new GPIOPin($number, $this);
    }

    public function getHandler()
    {
        return $this->handler;
    }

}
