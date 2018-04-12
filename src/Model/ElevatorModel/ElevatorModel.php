<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 20:39
 */

namespace App\Model\ElevatorModel;


class ElevatorModel
{
    private $currentFloor;

    const ACTIVE = "ACTIVE";

    const INACTIVE = "INACTIVE";

    private $status;

    private $direction;

    private $nextFloor = false;

    private $selectedFloors = array();

    public function __construct()
    {
        $this->currentFloor = mt_rand(1,9);
        $this->status = self::INACTIVE;
        $this->direction = 0;
    }

    public function goUp()
    {
        $this->currentFloor++;
    }

    public function goDown()
    {
        $this->currentFloor--;
    }

    public function stop()
    {
        $this->direction = 0;
        $this->status = self::INACTIVE;
    }

    public function addSelectedFloors($floorNumber)
    {

        if (!in_array($floorNumber,$this->selectedFloors))
        {
            $this->selectedFloors[] = $floorNumber;
        }
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function updateNextFloor()
    {
        $restFloors = $this->getRestFloors($this->currentFloor,$this->direction);
      //  var_dump($restFloors,$this->selectedFloors);die;
        if (empty($restFloors)) {
            $this->direction = $this->direction === 1 ? -1 : 1;
            $restFloors = $this->getRestFloors($this->currentFloor,$this->direction);
        }

        if (empty($restFloors))
        {
           var_dump($this->selectedFloors);die;
        }
       // var_dump($restFloors);die;
        $this->nextFloor = $restFloors[0];

    }

    public function calling($floor)
    {
        if ($this->status = self::INACTIVE && $floor !== $this->currentFloor) {
            $this->direction = $this->currentFloor > $floor ? -1 : 1;
            $this->status = self::ACTIVE;
        }
        $this->addSelectedFloors($floor);
    }

    public function getCurrentFloor()
    {
        return $this->currentFloor;
    }

    public function getRestFloors($currentFloor,$direction)
    {
        return array_filter(
            $this->selectedFloors,
            function ($value) use($currentFloor,$direction) {
                return (($direction==1 && $value > $currentFloor) || ($direction==-1 && $value<$currentFloor));
            }
        );
    }

    public function move()
    {
        if ($this->direction === 1) {
            $this->goUp();
        } else {
            $this->goDown();
        }
    }

    public function getNextFloor()
    {
        return $this->nextFloor;
    }

}