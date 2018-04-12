<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 20:40
 */

namespace App\Model\UserModel;


class UserModel
{
    private $neededFloor;
    private $currentFloor;

    public $username;

    public function __construct($username)
    {
        $this->neededFloor = mt_rand(1,9);
        $this->currentFloor = mt_rand(1,9);

        $this->username = $username;
        echo "$username is on {$this->currentFloor}\n";
        echo "$username need go on {$this->neededFloor}\n\n";
    }


    public function getNeededFloorNumber()
    {
        return $this->neededFloor;
    }

    public function getCurrentFloor()
    {
        return $this->currentFloor;
    }


}