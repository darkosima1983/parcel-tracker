<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Shipment;    
use App\Models\User;
class CreateShipment extends Component
{
    public string $title;
    public string $from_city;
    public string $from_state;  
    public string $to_city;
    public string $to_state;
    public string $price;
    public array $statuses = [];
    public string $status = '';
    public int $client_id;
    public string $clientError;

      public function validateClient()
    {
       /* $client = User::firstWhere('id', $this->client_id);

      $this->clientError = $client ? '' : 'Client ID does not exist.';*/
       /* if (!$client) {
            $this->clientError = 'Client ID does not exist.';
        } else {
            $this->clientError = '';
        }*/

             $this->validate([
            'client_id' => 'required|exists:users,id',
        ]);

    }
    
    public function render()
    {
            return view('livewire.create-shipment');
        }

    public function mount()
    {
        $this->statuses = [
            Shipment::STATUS_IN_PROGRESS => 'In Progress',
            Shipment::STATUS_UNASSIGNED => 'Unassigned',
            Shipment::STATUS_COMPLETED => 'Completed',
            Shipment::STATUS_PROBLEM => 'Problem',
        ];
    }

}