<?php
namespace WaffleSystems\GPIO;

class GPIOServiceFactory
{

    public static function createForRaspberryPi()
    {
        return new GPIOService(new RaspberryPiGPIOInterface());
    }

}
