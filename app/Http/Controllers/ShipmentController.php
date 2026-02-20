<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Http\Requests\NewShipmentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Models\ShipmentDocument;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\UpdateShipmentRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
class ShipmentController extends Controller
{
    use ImageUploadTrait;
   public function index()
    {
        
            $shipments = Cache::remember(
            'shipments_unassigned',
            now()->addMinutes(10),
            fn()=> Shipment::Unassigned()->get()
        );
       
        return view('shipments.index', compact('shipments'));
    }


    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
         Gate::authorize('showCreate', Shipment::class);
         $truckers = User::where('role', User::ROLE_TRUCKER)->get();
        return view('shipments.create', compact('truckers'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(NewShipmentRequest $request)
    {
        Gate::authorize('create', Shipment::class);

        $data = $request->validated();
        $shipment = Shipment::create($data);

        $fileTypes = [
            'application/pdf' => 'pdf',
            'application/msword' => 'document',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'document',
        ];
        foreach ($request->file('documents') as $document) {
           if(str_starts_with($document->getMimeType(), 'image/')){
               
                $filename = $this->uploadImage($document, "documents/{$shipment->id}");
                $path = "documents/{$shipment->id}/{$filename}";
                
                $shipment->documents()->create([
                    'file_name' => $filename,
                    'file_path' => $path,
                    'original_name' => $document->getClientOriginalName(),
                    'mime_type' => $document->getMimeType(),
                    'size' => $document->getSize(),
                    'file_type' => 'image',
                ]);
                
            } elseif(array_key_exists($document->getMimeType(), $fileTypes)){
                
                $extension = $document->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $path = $document->storeAs('documents/' . $shipment->id, $filename, 'public');
                
                $shipment->documents()->create([
                    'original_name' => $document->getClientOriginalName(),
                    'file_name' => $filename,
                    'file_path' => $path,
                    'mime_type' => $document->getMimeType(),
                    'file_type' => $fileTypes[$document->getMimeType()],
                    'size' => $document->getSize(),
                ]);
            }
        }
       

        //Cache::forget('shipments_unassigned');

        return redirect()->route('shipments.index')
                        ->with('success', 'Shipment created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        Gate::authorize('view', $shipment);
        return view('shipments.details', compact('shipment'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        
       Gate::authorize('showEdit', $shipment);
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        
        $shipment->update($request->validated());
        return redirect()->route('shipments.index')
                         ->with('success', 'Shipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

       

        return back()->with('success', 'Shipment deleted.');
    }

    public function assignUser(Request $request, Shipment $shipment): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $shipment->user_id = $request->user_id;
        $shipment->status = Shipment::STATUS_IN_PROGRESS;
        $shipment->save();

        return redirect()->route('shipments.index')->with('success', 'Shipment assigned successfully.');
    }

}
