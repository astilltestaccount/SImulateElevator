<?php
require 'vendor/autoload.php';
use App\Controller\ElevatorController;
use App\Model\UserModel\UserModel;
use App\Model\ElevatorModel\ElevatorModel;

$elevator = new ElevatorModel();
//die('dsf');
$elevatorController = new ElevatorController($elevator);
$userA = new UserModel('User A');
$userB = new UserModel('User B');
$userC = new UserModel('User C');

$elevatorController->callElevator($userA);

$elevatorController->addUser($userB);
$elevatorController->addUser($userC);

$elevatorController->go();

