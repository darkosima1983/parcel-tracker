<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Http\Requests\NewShipmentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $shipments = Cache::remember(
        'shipments_unassigned',
        now()->addMinutes(10),
        fn()=> Shipment::where('status', Shipment::STATUS_UNASSIGNED)->get()
    );

    return view('shipments.index', compact('shipments'));
}


    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $users = User::all(); // dohvat svih korisnika
        return view('shipments.create', compact('users'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(NewShipmentRequest $request)
    {
        $data = $request->validated();
        Shipment::create($data);

        Cache::forget('shipments_unassigned');

        return redirect()->route('shipments.index')
                        ->with('success', 'Shipment created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.details', compact('shipment'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        Cache::forget('shipments_unassigned');

        return back()->with('success', 'Shipment deleted.');
    }

}
