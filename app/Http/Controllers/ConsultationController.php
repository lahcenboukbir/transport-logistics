<?php

namespace App\Http\Controllers;

use App\Models\AirEquipment;
use App\Models\Consultation;
use App\Models\MaritimeEquipment;
use App\Models\RoadEquipment;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display consultations|create consultations|view consultations|edit consultations|delete consultations|manage confirmation consultations', ['only' => ['index']]);
        $this->middleware('permission:create consultations', ['only' => ['create', 'store']]);
        $this->middleware('permission:view consultations', ['only' => ['view']]);
        $this->middleware('permission:edit consultations', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete consultations', ['only' => ['destroy']]);
        $this->middleware('permission:manage confirmation consultations', ['only' => ['confirm', 'unconfirm', 'notes', 'concretisation']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = DB::table('consultations')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'consultations.user_id', 'users.id')
            ->join('shipments', 'consultations.id', 'shipments.consultation_id')
            ->select('consultations.*', 'users.name as user_name', 'prospects.name', 'shipments.selling_price', 'shipments.buying_price', 'shipments.agent_commission')
            ->get();
        foreach ($consultations as $consultation) {
            $consultation->confirmation_date = $consultation->confirmation_date ? Carbon::parse($consultation->confirmation_date)->format('d/m/Y - H:m') : null;
            $consultation->consultation_date = $consultation->consultation_date ?  Carbon::parse($consultation->consultation_date)->format('d/m/Y - H:m') : null;
        }

        return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select('customers.id', 'prospects.name')
            ->get();

        $ports = DB::table('ports')->get();

        $maritime_equipments = DB::table('equipment_names')->where('type', 'maritime')->get();

        $road_equipments = DB::table('equipment_names')->where('type', 'road')->get();

        return view('consultations.create', compact('customers', 'ports', 'maritime_equipments', 'road_equipments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consultation_date' => 'required|date',

            'departure_port_id' => 'required|exists:ports,id',
            'arrival_port_id' => 'required|exists:ports,id',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'quantity' => 'nullable|integer|min:1',
            'medium_name' => 'required|in:air,maritime,road',
        ]);

        if ($validated['medium_name'] === 'air') {
            $validated = array_merge($validated, $request->validate([
                'volume' => 'required|numeric',
                'weight' => 'required|numeric',
            ]));
        } elseif ($validated['medium_name'] === 'maritime') {
            $validated = array_merge($validated, $request->validate([
                'maritime_equipment_id' => 'required|exists:equipment_names,id'
            ]));
        } elseif ($validated['medium_name'] === 'road') {
            $validated = array_merge($validated, $request->validate([
                'road_equipment_id' => 'required|exists:equipment_names,id'
            ]));
        }

        $consultation = Consultation::create([
            'customer_id' => $validated['customer_id'],
            'user_id' => auth()->id(),
            'consultation_date' => $validated['consultation_date'],
        ]);

        $shipment = Shipment::create([
            'consultation_id' => $consultation->id,
            'departure_port_id' => $validated['departure_port_id'],
            'arrival_port_id' => $validated['arrival_port_id'],
            'departure_date' => $validated['departure_date'],
            'arrival_date' => $validated['arrival_date'],
            'quantity' => $validated['quantity'],
            'medium_name' => $validated['medium_name'],
        ]);

        if ($validated['medium_name'] === 'air') {
            AirEquipment::create([
                'shipment_id' => $shipment->id,
                'volume' => $validated['volume'],
                'weight' => $validated['weight'],
            ]);
        } elseif ($validated['medium_name'] === 'maritime') {
            MaritimeEquipment::create([
                'shipment_id' => $shipment->id,
                'equipment_name_id' => $validated['maritime_equipment_id'],
            ]);
        } elseif ($validated['medium_name'] === 'road') {
            RoadEquipment::create([
                'shipment_id' => $shipment->id,
                'equipment_name_id' => $validated['road_equipment_id'],
            ]);
        }

        return redirect()->route('consultations.index')->with('success', 'Consultation créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $consultation = DB::table('consultations')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'consultations.user_id', 'users.id')
            ->select('consultations.*', 'prospects.name as customer_name', 'prospects.status as customer_status', 'prospects.company', 'users.id as user_id', 'users.name as user_name')
            ->where('consultations.id', $id)
            ->first();

        $consultation->confirmation_date = Carbon::parse($consultation->confirmation_date)->format('d/m/Y - H:m');
        $consultation->consultation_date = Carbon::parse($consultation->consultation_date)->format('d/m/Y - H:m');

        $shipment = DB::table('shipments')
            ->join('ports as departure_ports', 'shipments.departure_port_id', 'departure_ports.id')
            ->join('ports as arrival_ports', 'shipments.arrival_port_id', 'arrival_ports.id')
            ->select(
                'departure_ports.port_name as departure_port',
                'arrival_ports.port_name as arrival_port',
                'shipments.*',
            )
            ->where('shipments.consultation_id', $id)
            ->first();

        $shipment->departure_date = Carbon::parse($shipment->departure_date)->format('d/m/Y - H:m');
        $shipment->arrival_date = Carbon::parse($shipment->arrival_date)->format('d/m/Y - H:m');

        if ($shipment->medium_name === 'air') {
            $equipment = DB::table('shipments')
                ->join('air_equipments', 'shipments.id', 'air_equipments.shipment_id')
                ->select('shipments.consultation_id', 'air_equipments.*')
                ->where('shipments.consultation_id', $id)
                ->first();
        } elseif ($shipment->medium_name === 'maritime') {
            $equipment = DB::table('shipments')
                ->join('maritime_equipments', 'shipments.id', 'maritime_equipments.shipment_id')
                ->join('equipment_names', 'maritime_equipments.equipment_name_id', 'equipment_names.id')
                ->select('shipments.consultation_id', 'maritime_equipments.*', 'equipment_names.*')
                ->where('shipments.consultation_id', $id)
                ->first();
        } elseif ($shipment->medium_name === 'road') {
            $equipment = DB::table('shipments')
                ->join('road_equipments', 'shipments.id', 'road_equipments.shipment_id')
                ->join('equipment_names', 'road_equipments.equipment_name_id', 'equipment_names.id')
                ->select('shipments.consultation_id', 'road_equipments.*', 'equipment_names.*')
                ->where('shipments.consultation_id', $id)
                ->first();
        }

        return view('consultations.show', compact('consultation', 'shipment', 'equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customers = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select('customers.id', 'prospects.name')
            ->get();

        $ports = DB::table('ports')->select('id', 'port_name')->get();

        $maritime_equipments = DB::table('equipment_names')->where('type', 'maritime')->get();

        $road_equipments = DB::table('equipment_names')->where('type', 'road')->get();

        $consultation = DB::table('consultations')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('shipments', 'consultations.id', 'shipments.consultation_id')
            ->select('customers.id as customer_id', 'consultations.id as consultation_id', 'consultations.*', 'shipments.id as shipment_id', 'shipments.*')
            ->where('consultations.id', $id)
            ->first();

        if ($consultation->medium_name === 'air') {
            $shipment = DB::table('shipments')
                ->join('air_equipments', 'shipments.id', 'air_equipments.shipment_id')
                ->where('shipments.consultation_id', $id)
                ->first();

            $selected_equipment = 1;
        } elseif ($consultation->medium_name === 'maritime') {
            $shipment = DB::table('shipments')
                ->join('maritime_equipments', 'shipments.id', 'maritime_equipments.shipment_id')
                ->where('shipments.consultation_id', $id)
                ->first();

            $selected_equipment = DB::table('shipments')
                ->join('maritime_equipments', 'shipments.id', 'maritime_equipments.shipment_id')
                ->select('shipments.consultation_id', 'maritime_equipments.*')
                ->where('consultation_id', $id)
                ->first();
        } elseif ($consultation->medium_name === 'road') {
            $shipment = DB::table('shipments')
                ->join('road_equipments', 'shipments.id', 'road_equipments.shipment_id')
                ->where('shipments.consultation_id', $id)
                ->first();

            $selected_equipment = DB::table('shipments')
                ->join('road_equipments', 'shipments.id', 'road_equipments.shipment_id')
                ->select('shipments.consultation_id', 'road_equipments.*')
                ->where('consultation_id', $id)
                ->first();
        }

        return view('consultations.edit', compact(
            'customers',
            'ports',
            'maritime_equipments',
            'road_equipments',
            'consultation',
            'shipment',
            'selected_equipment'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consultation_date' => 'nullable|date',

            'departure_port_id' => 'required|exists:ports,id',
            'arrival_port_id' => 'required|exists:ports,id',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'medium_name' => 'required|in:air,maritime,road',
        ]);

        if ($validated['medium_name'] === 'air') {
            $validated = array_merge($validated, $request->validate([
                'volume' => 'required|numeric',
                'weight' => 'required|numeric',
            ]));
        } elseif ($validated['medium_name'] === 'maritime') {
            $validated = array_merge($validated, $request->validate([
                'maritime_equipment_id' => 'required|exists:equipment_names,id'
            ]));
        } elseif ($validated['medium_name'] === 'road') {
            $validated = array_merge($validated, $request->validate([
                'road_equipment_id' => 'required|exists:equipment_names,id'
            ]));
        }

        Consultation::where('id', $id)->update([
            'customer_id' => $validated['customer_id'],
            'consultation_date' => $validated['consultation_date'],
        ]);

        Shipment::where('consultation_id', $id)->update([
            'departure_port_id' => $validated['departure_port_id'],
            'arrival_port_id' => $validated['arrival_port_id'],
            'departure_date' => $validated['departure_date'],
            'arrival_date' => $validated['arrival_date'],
            'quantity' => $validated['quantity'],
            'medium_name' => $validated['medium_name'],
        ]);

        $shipment_id = Shipment::where('consultation_id', $id)->value('id');

        if ($validated['medium_name'] === 'air') {
            AirEquipment::updateOrCreate(
                ['shipment_id' => $shipment_id],
                [
                    'volume' => $validated['volume'],
                    'weight' => $validated['weight'],
                ]
            );

            MaritimeEquipment::where('shipment_id', $shipment_id)->delete();
            RoadEquipment::where('shipment_id', $shipment_id)->delete();
        } elseif ($validated['medium_name'] === 'maritime') {
            MaritimeEquipment::updateOrCreate(
                ['shipment_id' => $shipment_id],
                [
                    'equipment_name_id' => $validated['maritime_equipment_id'],
                ]
            );

            AirEquipment::where('shipment_id', $shipment_id)->delete();
            RoadEquipment::where('shipment_id', $shipment_id)->delete();
        } elseif ($validated['medium_name'] === 'road') {
            RoadEquipment::updateOrCreate(
                ['shipment_id' => $shipment_id],
                [
                    'equipment_name_id' => $validated['road_equipment_id'],
                ]
            );

            AirEquipment::where('shipment_id', $shipment_id)->delete();
            MaritimeEquipment::where('shipment_id', $shipment_id)->delete();
        }

        return redirect()->route('consultations.edit', $id)->with('success', 'Consultation mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $consultation = Consultation::find($id);

        if ($consultation) {
            $consultation->delete();

            return redirect()->route('consultations.index')->with('success', 'Consultation supprimée avec succès !');
        }
    }

    /**
     * Confirmation.
     */
    public function confirm($id)
    {
        Consultation::where('id', $id)->update([
            'confirmation_date' => now()
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation confirmée avec succès !');
    }

    /**
     * unconfirm.
     */
    public function unconfirm($id)
    {
        Consultation::where('id', $id)->update([
            'confirmation_date' => null,
            'notes' => null,
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation non confirmée !');
    }

    /**
     * Notes.
     */
    public function notes(Request $request, $id)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string|max:255',
        ]);

        Consultation::where('id', $id)->update([
            'notes' => $validated['notes']
        ]);

        return redirect()->route('consultations.index')->with('success', 'Remarques ajoutées avec succès !');
    }

    /**
     * Concretisation.
     */
    public function concretisation(Request $request, $id)
    {
        $validated = $request->validate([
            'selling_price' => 'nullable|numeric',
            'buying_price' => 'nullable|numeric',
            'agent_commission' => 'nullable|numeric',
        ]);

        Shipment::where('consultation_id', $id)->update([
            'selling_price' => $validated['selling_price'],
            'buying_price' => $validated['buying_price'],
            'agent_commission' => $validated['agent_commission'],
        ]);

        return redirect()->route('consultations.index');
    }
}
