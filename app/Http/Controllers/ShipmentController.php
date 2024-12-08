<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display shipments|manage status shipments', ['only' => ['index']]);
        $this->middleware('permission:manage status shipments', ['only' => ['status', 'delayed']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = DB::table('shipments')
            ->join('consultations', 'shipments.consultation_id', 'consultations.id')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'consultations.user_id', 'users.id')
            ->join('ports as departure_ports', 'shipments.departure_port_id', 'departure_ports.id')
            ->join('ports as arrival_ports', 'shipments.arrival_port_id', 'arrival_ports.id')
            ->select('shipments.*', 'departure_ports.port_name as departure_port', 'arrival_ports.port_name as arrival_port', 'prospects.name as customer_name', 'prospects.company', 'users.name as user_name')
            ->get();

        foreach ($shipments as $shipment) {
            $shipment->duration = Carbon::parse($shipment->departure_date)->diffInDays(Carbon::parse($shipment->arrival_date));
            $shipment->formatted_duration = $shipment->duration >= 1 ? $shipment->duration . ' jours' : ($shipment->duration < 1 ? Carbon::parse($shipment->departure_date)->diffInHours(Carbon::parse($shipment->arrival_date)) . ' heures' : '');

            $shipment->departure_date = Carbon::parse($shipment->departure_date)->format('d/m/Y - H:m');
            $shipment->arrival_date = Carbon::parse($shipment->arrival_date)->format('d/m/Y - H:m');
            $shipment->depart = $shipment->departure_port . ' (' . $shipment->departure_date . ')';
            $shipment->arrival = $shipment->arrival_port . ' (' . $shipment->arrival_date . ')';
            $shipment->medium_name =  $shipment->medium_name === 'maritime' ? 'Maritime' : ($shipment->medium_name === 'road' ? 'Route' : ($shipment->medium_name === 'air' ? 'Aérien' : ''));
            $shipment->status = $shipment->status === 'in_transit' ? 'En transit' : ($shipment->status === 'delivered' ? 'Livré' : ($shipment->status === 'pending' ? 'En attente' : ($shipment->status === 'canceled' ? 'Annulé' : '')));
        }

        // dd($shipments);

        return view('shipments.index', compact('shipments'));
    }

    /**
     * status
     */
    public function status(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'nullable|in:in_transit,delivered,pending,canceled',
        ]);

        $shipment = Shipment::find($id);
        $shipment->update([
            'status' => $validated['status']
        ]);

        return redirect()->route('shipments.index')->with('success', "Statut de l'expédition mis à jour avec succès !");
    }

    /**
     * status
     */
    public function delayed(Request $request, string $id)
    {
        $validated = $request->validate([
            'delayed_reason' => 'nullable|string',
        ]);

        $shipment = Shipment::find($id);
        $shipment->update([
            'delayed_reason' => $validated['delayed_reason']
        ]);

        return redirect()->route('shipments.index')->with('success', "Raison du retard de l'expédition mise à jour avec succès !");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
