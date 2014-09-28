<?php
namespace WaffleSystems\GPIO;

interface GPIOInterface
{

    /**
     * @return void
     */
    public function enablePin($number);

    /**
     * @return void
     */
    public function disablePin($number);

    /**
     * @return boolean
     */
    public function isPinEnabled($number);

    public function getPinDirection($number);

    /**
     * @return void
     */
    public function setPinDirection($number, $direction);

    public function getPinValue($number);

    /**
     * @return void
     */
    public function setPinValue($number, $value);

}
