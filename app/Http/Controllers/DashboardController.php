<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // overview - cards
        $total_users = DB::table('users')->count();
        $total_prospects = DB::table('prospects')->count();
        $total_customers = DB::table('customers')->count();
        $conversion_rate = $total_customers > 0 && $total_prospects > 0 ? ($total_customers / $total_prospects) * 100 : 0;
        $upcoming_appointments = DB::table('appointments')->where('outcome', 'pending')->count();
        $active_shipments = DB::table('shipments')->whereIn('status', ['pending', 'in_transit'])->count();
        $total_equipments = DB::table('equipment_names')->count();
        $selling_price = DB::table('shipments')->select('selling_price')->sum('selling_price');
        $buying_price = DB::table('shipments')->select('buying_price')->sum('buying_price');
        $agent_commission = DB::table('shipments')->select('agent_commission')->sum('agent_commission');
        $revenue = $selling_price - ($buying_price + $agent_commission);

        // prospects - pie chart
        $new_prospects = DB::table('prospects')->where('status', 'new')->count();
        $interested_prospects = DB::table('prospects')->where('status', 'interested')->count();
        $not_interested_prospects = DB::table('prospects')->where('status', 'not interested')->count();
        $total_prospects_status = $new_prospects + $interested_prospects + $not_interested_prospects;
        $new_prospects_rate =  $new_prospects > 0 && $total_prospects_status > 0 ? ($new_prospects / $total_prospects_status) * 100 : 0;
        $interested_prospects_rate = $interested_prospects > 0 && $total_prospects_status > 0 ? ($interested_prospects / $total_prospects_status) * 100 : 0;
        $not_interested_prospects_rate = $not_interested_prospects > 0 && $total_prospects_status > 0 ? ($not_interested_prospects / $total_prospects_status) * 100 : 0;

        // appointments - radialbar
        $successful_appointments = DB::table('appointments')->where('outcome', 'success')->count();
        $failed_appointments = DB::table('appointments')->where('outcome', 'fail')->count();
        $pending_appointments = DB::table('appointments')->where('outcome', 'pending')->count();

        // new prospects
        $new_prospects_list = DB::table('prospects')
            ->join('users', 'prospects.user_id', 'users.id')
            ->select('prospects.*', 'users.id as user_id', 'users.name as user_name', 'users.img')
            ->where('status', '!=', 'customer')
            ->limit(5)
            ->get();

        // new customers
        $new_customers_list = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'customers.user_id', 'users.id')
            ->select('customers.*', 'prospects.name', 'prospects.company', 'users.name as user_name', 'users.img')
            ->limit(5)
            ->get();

        // appointments lists
        $current_date = Carbon::now()->format('Y-m-d');
        $tomorrow_date = Carbon::now()->addDay()->format('Y-m-d');

        function appointments($date)
        {
            $appointments = DB::table('appointments')
                ->join('prospects', 'appointments.prospect_id', 'prospects.id')
                ->join('users', 'appointments.user_id', 'users.id')
                ->select('users.name as user_name', 'users.img', 'users.id', 'appointments.appointment_date', 'prospects.*')
                ->whereDate('appointments.appointment_date', $date)
                ->get();
            foreach ($appointments as $appointment) {
                $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('d/m/Y - H:m');
            }

            return $appointments;
        }

        $today_appointments = appointments($current_date);
        $tomorrow_appointments = appointments($tomorrow_date);

        // shipments
        // function shipments($status)
        // {
        //     $shipments = DB::table('shipments')
        //         ->join('ports as departure_ports', 'shipments.departure_port_id', 'departure_ports.id')
        //         ->join('ports as arrival_ports', 'shipments.arrival_port_id', 'arrival_ports.id')
        //         ->join('consultations', 'shipments.consultation_id', 'consultations.id')
        //         ->join('customers', 'consultations.customer_id', 'customers.id')
        //         ->join('prospects', 'customers.prospect_id', 'prospects.id')
        //         ->join('users', 'customers.user_id', 'users.id')
        //         ->select('shipments.*', 'departure_ports.port_name as departure_port', 'arrival_ports.port_name as arrival_port', 'customers.id as customer_id', 'prospects.name as customer_name', 'prospects.company', 'users.id as user_id', 'users.name as user_name', 'users.img')
        //         ->where('shipments.status', $status)
        //         ->limit(5)
        //         ->get();

        //     foreach ($shipments as $shipment) {
        //         $shipment->departure_date = Carbon::parse($shipment->departure_date)->format('d/m/Y');
        //         $shipment->arrival_date = Carbon::parse($shipment->arrival_date)->format('d/m/Y');
        //         $shipment->medium_name =  $shipment->medium_name === 'maritime' ? 'Maritime' : ($shipment->medium_name === 'road' ? 'Route' : ($shipment->medium_name === 'air' ? 'Aérien' : ''));
        //     }

        //     return $shipments;
        // }

        // $pending_shipments = shipments('pending');
        // $in_transit_shipments = shipments('in_transit');
        // $delivered_shipments = shipments('delivered');
        // $canceled_shipments = shipments('canceled');

        // shipments
        function shipments($status)
        {
            $shipments = DB::table('shipments')
                ->join('ports as departure_ports', 'shipments.departure_port_id', 'departure_ports.id')
                ->join('ports as arrival_ports', 'shipments.arrival_port_id', 'arrival_ports.id')
                ->join('consultations', 'shipments.consultation_id', 'consultations.id')
                ->select('shipments.*', 'departure_ports.port_name as departure_port', 'arrival_ports.port_name as arrival_port')
                ->where('shipments.status', $status)
                ->limit(5)
                ->get();

            foreach ($shipments as $shipment) {
                $shipment->departure_date = Carbon::parse($shipment->departure_date)->format('d/m/Y');
                $shipment->arrival_date = Carbon::parse($shipment->arrival_date)->format('d/m/Y');
                $shipment->medium_name =  $shipment->medium_name === 'maritime' ? 'Maritime' : ($shipment->medium_name === 'road' ? 'Route' : ($shipment->medium_name === 'air' ? 'Aérien' : ''));
            }

            return $shipments;
        }

        $pending_shipments = shipments('pending');
        $in_transit_shipments = shipments('in_transit');
        $delivered_shipments = shipments('delivered');
        $canceled_shipments = shipments('canceled');

        // equipments
        $maritime_equipment_distribution = DB::table('shipments')->where('medium_name', 'maritime')->count();
        $road_equipment_distribution = DB::table('shipments')->where('medium_name', 'road')->count();
        $volume = DB::table('air_equipments')->sum('volume');
        $weight = DB::table('air_equipments')->sum('weight');
        $total_air_equipments = DB::table('air_equipments')->count();
        $volume_average = $total_air_equipments > 0 ? ($volume / $total_air_equipments) : 0;
        $weight_average = $total_air_equipments > 0 ? ($weight / $total_air_equipments) : 0;

        function most_used_equipment($type)
        {
            $equipment = DB::table('shipments')
                ->join($type, 'shipments.id', $type . '.shipment_id')
                ->join('equipment_names', $type . '.equipment_name_id', 'equipment_names.id')
                ->select('shipments.medium_name', 'equipment_names.equipment_name', DB::raw('COUNT(equipment_names.id) as total_equipment_names'))
                ->groupBy('shipments.medium_name', 'equipment_names.equipment_name')
                ->orderBy('total_equipment_names', 'desc')
                ->limit(3)
                ->get();

            return $equipment;
        }

        $most_maritime_equipments = most_used_equipment('maritime_equipments');
        $most_road_equipments = most_used_equipment('road_equipments');

        return view('dashboard.index', compact(
            'total_users',
            'total_prospects',
            'total_customers',
            'conversion_rate',
            'upcoming_appointments',
            'active_shipments',
            'total_equipments',
            'revenue',

            'new_prospects',
            'interested_prospects',
            'not_interested_prospects',
            'new_prospects_rate',
            'interested_prospects_rate',
            'not_interested_prospects_rate',

            'successful_appointments',
            'failed_appointments',
            'pending_appointments',

            'new_prospects_list',
            'new_customers_list',

            'today_appointments',
            'tomorrow_appointments',

            'pending_shipments',
            'in_transit_shipments',
            'delivered_shipments',
            'canceled_shipments',

            'maritime_equipment_distribution',
            'road_equipment_distribution',
            'volume_average',
            'weight_average',
            'most_maritime_equipments',
            'most_road_equipments',
        ));
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
