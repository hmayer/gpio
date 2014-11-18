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

    /**
     * @return string
     */
    public function getPinDirection($number);

    /**
     * @return void
     */
    public function setPinDirection($number, $direction);

    /**
     * @return string
     */
    public function getPinValue($number);

    /**
     * @return void
     */
    public function setPinValue($number, $value);
}
