<?php
namespace WaffleSystems\Tests\GPIO;

use WaffleSystems\GPIO\GPIOService;
use WaffleSystems\GPIO\GPIOServiceFactory;

class GPIOServiceTest extends \PHPUnit_Framework_TestCase
{

    public function testRaspberryPiFactory()
    {
        $factory = GPIOServiceFactory::createForRaspberryPi();

        $this->assertTrue($factory instanceof GPIOService);
        $this->assertTrue($factory->getHandler() instanceof RaspberryPiGPIOInterface);
    }

}
