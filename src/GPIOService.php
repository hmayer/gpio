<?php
namespace WaffleSystems\GPIO;

class GPIOService
{

    public $handler;

    public function __construct(GPIOInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param int $number
     */
    public function setup($number, $direction)
    {
        $this->handler->setupPin($number, $direction);
        return new Pin($number, $this, $direction);
    }

    public function getHandler()
    {
        return $this->handler;
    }
}
