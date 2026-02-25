<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipment;
use App\Models\User;

class ShipmentAssignedList extends Component
{
    public $clickCount = 0;
    public $amount = 1;
    public $errorMessage = '';
    public function render()
    {
        return view('livewire.shipment-assigned-list');
    }
    public function increment()
    {
        $this->clickCount+=$this->amount;
        $this->errorMessage = '';
    }   
    public function decrement()
    {
        $result = $this->clickCount - $this->amount;
        if($result >= 0){
            $this->clickCount -= $this->amount;
        } else {
            $this->errorMessage = 'Cannot decrement below zero.';
        }
    }

}
