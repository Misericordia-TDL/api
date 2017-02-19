<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models\Base;


/**
 * Class CommonTrait
 * @package App\Models\Base
 * @author Javier Mellado <sol@javiermellado.com>
 */
trait CommonTrait
{

    /**
     * @param $date
     * @return \DateTime
     */
    private function prepareDate($date): \DateTime
    {
        $dt = new \DateTime(date('d-m-Y'));
        list($day, $month, $year) = explode('-', $date);
        $ts = $dt->setDate($year, $month, $day);
        return $ts;
    }

    /**
     * @param $data
     * @param $dates
     * @return array
     */
    private function prepareDateFields(&$data, $dates) : array
    {
        foreach ($dates as $date) {
            $data[$date] = $this->prepareDate($data[$date]);
        }

        return $data;
    }
}