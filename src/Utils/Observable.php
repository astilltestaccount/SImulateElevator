<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11.04.2018
 * Time: 21:24
 */

namespace App\Utils;


interface  Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();

//    function notify()
//    {
//        foreach ($this->observers as $obs) {
//            $obs->update($this);
//        }
//    }
//
//    public function attach(Observer $observer)
//    {
//        $this->observers[] = $observer;
//    }
//
//    public function detach(Observer $observer)
//    {
//        $this->observers = array_filter($this->observers, function ($а) use ($observer) {
//            return (!($а === $observer));
//        });
//    }
}