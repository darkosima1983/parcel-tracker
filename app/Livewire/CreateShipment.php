<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Shipment;    
use App\Models\User;
use App\Http\Requests\NewShipmentRequest;
use App\Services\ShipmentService;
class CreateShipment extends Component
{
    use WithFileUploads;

    public string $title;
    public string $from_city;
    public string $from_state;  
    public string $to_city;
    public string $to_state;
    public string $price;
    public array $statuses = [];
    public string $status = '';
    public ?int $user_id = null;
    public int $client_id;
    public string $clientError;
    public array $documents = [];
    public string $details = '';

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

    public function submit(ShipmentService $shipmentService)
    {
        $request = new NewShipmentRequest();
        $response = $this->validate($request->rules());
        $shipmentService->store($response);
    }
}