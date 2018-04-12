<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 20:36
 */

namespace App\Controller;
use App\Model\UserModel\UserModel;
use App\Model\ElevatorModel\ElevatorModel;
use App\Utils\Observable;
use App\Utils\SpecificationInterface;

class ElevatorController
{
    private $passengers = array();
    private $users = array();
    private $elevator;
    private $specifications = array();

    public function __construct(ElevatorModel $elevator)
    {
        $this->elevator = $elevator;
    }

    public function addUser(UserModel $user)
    {
        $this->users[] = $user;
    }
    public function addSpecifications(SpecificationInterface $specification)
    {
        $this->specifications[] = $specification;
    }

    public function actionPressFloorButton($floorNumber)
    {
        $this->elevator->addSelectedFloors($floorNumber);
    }

    public function actionExitFromElevator(UserModel $user)
    {
        $this->passengers = array_filter($this->passengers, function ($а) use ($user) {
            return (!($а === $user));
        });
    }

    public function callElevator(UserModel $user)
    {
        $this->elevator->calling($user->getNeededFloorNumber());
    }

    public function goToElevator(array $users)
    {
        foreach ($users as $user) {
            $this->passengers[] = $user;
            $this->actionPressFloorButton($user->getNeededFloorNumber());
        }

        $this->go();
    }

    public function go()
    {
        $this->elevator->updateNextFloor();
//        var_dump($this->elevator->getNextFloor());
        while ($this->elevator->getNextFloor() != $this->elevator->getCurrentFloor()) {
            $this->elevator->move();
        }
        $this->check();


    }

    public function check()
    {
        foreach ($this->passengers as $user) {
            if ($user->getNeededFloorNumber() === $this->elevator->getCurrentFloor()) {
                $f = $this->elevator->getCurrentFloor();
                $this->actionExitFromElevator($user);
                echo "{$user->username} go awy from floor  {$f}\n\n";

            }
        }

        $readyUsers = array();
        foreach ($this->users as $key=>$user) {
            if ($user->getCurrentFloor() === $this->elevator->getCurrentFloor()) {
                $f = $user->getCurrentFloor();
                $readyUsers[] = $user;
                echo "{$user->username} go to elevator on fllor  {$f}\n\n";
                unset($this->users[$key]);
            }
        }
        $this->goToElevator($readyUsers);
    }





}