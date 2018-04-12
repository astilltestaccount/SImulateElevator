<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 21:58
 */

namespace App\Model\ElevatorModel;

use App\Model\UserModel\UserModel;
use App\Utils\SpecificationInterface;

class FloorSpecification implements SpecificationInterface
{
    private $currentFloor;

    public function __construct($currentFloor)
    {
        $this->currentFloor = $currentFloor;
    }

    public function isSatisfiedBy(UserModel $user)
    {
        if ($this->currentFloor !== null && $user->getNeededFloorNumber() !== $this->currentFloor) {
            return false;
        }
    }

}