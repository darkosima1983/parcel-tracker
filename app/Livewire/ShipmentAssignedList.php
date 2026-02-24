<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipment;
use App\Models\User;

class ShipmentAssignedList extends Component
{
    public function render()
    {
        $shipments = Shipment::where('status', Shipment::STATUS_UNASSIGNED)->get();
        
        return view('livewire.shipment-assigned-list', [
            'shipments' => $shipments,
        ]);
    }
}