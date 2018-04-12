<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 21:56
 */

namespace App\Utils;
use App\Model\UserModel\UserModel;

interface SpecificationInterface
{
    public function isSatisfiedBy(UserModel $user);
}