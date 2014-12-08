<?php
namespace WaffleSystems\GPIO;

interface GPIOInterface
{

    /**
     * @return void
     */
    public function setupPin($number, $direction);

    /**
     * @return void
     */
    public function writeToPin($number, $value);

    /**
     * @return void
     */
    public function destroyPin($number);

    /**
     * @return int
     */
    public function readFromPin($number);
}
