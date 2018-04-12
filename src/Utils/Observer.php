<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 21:29
 */

namespace App\Utils;


interface Observer
{
    public function update(Observable $observable);
}