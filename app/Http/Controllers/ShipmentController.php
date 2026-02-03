<?php

namespace App\Http\Controllers;

use App\Models\Shipments;
use Illuminate\Http\Request;
use App\Http\Requests\NewShipmentRequest;
use App\Models\User;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $shipments = Shipments::all();

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
        Shipments::create($data);

        return redirect()->route('shipments.index')
                        ->with('success', 'Shipment created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shipments $shipments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipments $shipments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipments $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipments $shipments)
    {
        //
    }
}
