<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:download reports');
    }

    // users
    public function usersList()
    {
        $users = DB::table('users')->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($users))->download('liste_utilisateurs_' . $timestamp . '.xlsx', function ($user) {
            return [
                'Nom' => $user->name,
                'Email' => $user->email,
                'Numéro de téléphone' => $user->phone_number,
                'Statut' => $user->is_active ? 'Actif' : 'Inactif',
                'Date de création' => Carbon::parse($user->created_at)->format('Y-m-d'),
            ];
        });
    }

    // prospects
    public function prospectsList()
    {
        $prospects = DB::table('prospects')
            ->join('users', 'prospects.user_id', 'users.id')
            ->select('prospects.*', 'users.name as user_name')
            ->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($prospects))->download('liste_prospects_' . $timestamp . '.xlsx', function ($prospect) {
            return [
                'Contact' => $prospect->name,
                'Entreprise' => $prospect->company,
                'Email' => $prospect->email,
                'Numéro de téléphone' => $prospect->phone_number,
                'Date de création' => Carbon::parse($prospect->created_at)->format('m-d-Y'),
                'Ajouté par' => $prospect->user_name,
            ];
        });
    }

    // customers
    public function customersList()
    {
        $customers = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'customers.user_id', 'users.id')
            ->select('prospects.*', 'users.name as user_name')
            ->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($customers))->download('liste_clients_' . $timestamp . '.xlsx', function ($customer) {
            return [
                'Contact' => $customer->name,
                'Entreprise' => $customer->company,
                'Email' => $customer->email,
                'Numéro de téléphone' => $customer->phone_number,
                'Date de création' => Carbon::parse($customer->created_at)->format('m-d-Y'),
                'Ajouté par' => $customer->user_name,
            ];
        });
    }

    // appointments
    public function appointmentsList()
    {
        $appointments = DB::table('appointments')
            ->join('prospects', 'appointments.prospect_id', 'prospects.id')
            ->join('users', 'appointments.user_id', 'users.id')
            ->select('prospects.name', 'prospects.company', 'prospects.email',  'prospects.phone_number', 'appointments.*', 'users.name as user_name')
            ->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($appointments))->download('liste_rendez_vous_' . $timestamp . '.xlsx', function ($appointment) {
            return [
                'Contact' => $appointment->name,
                'Entreprise' => $appointment->company,
                'Email' => $appointment->email,
                'Numéro de téléphone' => $appointment->phone_number,
                'appointment' => Carbon::parse($appointment->appointment_date)->format('m-d-Y'),
                'Rendez-vous avec' => $appointment->user_name,
            ];
        });
    }

    // consultations
    public function consultationsList()
    {
        $consultations = DB::table('consultations')
            ->join('users', 'consultations.user_id', 'users.id')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select('consultations.*', 'users.name as user_name', 'prospects.name as customer_name', 'prospects.company', 'prospects.email', 'prospects.phone_number')
            ->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($consultations))->download('liste_rendez_vous_' . $timestamp . '.xlsx', function ($consultation) {
            return [
                'Contact' => $consultation->customer_name,
                'Entreprise' => $consultation->company,
                'Email' => $consultation->email,
                'Numéro de téléphone' => $consultation->phone_number,
                'Date de consultation' => Carbon::parse($consultation->consultation_date)->format('m-d-Y'),
                'Date de confirmation' => Carbon::parse($consultation->confirmation_date)->format('m-d-Y'),
                'Rendez-vous avec' => $consultation->user_name,
            ];
        });
    }

    // shipments
    public function shipmentsList()
    {
        $shipments = DB::table('shipments')
            ->join('consultations', 'shipments.consultation_id', 'consultations.id')
            ->join('ports as departure_ports', 'shipments.departure_port_id', 'departure_ports.id')
            ->join('ports as arrival_ports', 'shipments.arrival_port_id', 'arrival_ports.id')
            ->join('users', 'consultations.user_id', 'users.id')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select(
                'shipments.*',
                'departure_ports.port_name as departure_port',
                'arrival_ports.port_name as arrival_port',
                'users.name as user_name',
                'prospects.name as customer_name',
                'prospects.company',
                'prospects.phone_number',
                'prospects.email'
            )
            ->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($shipments))->download('liste_expéditions_' . $timestamp . '.xlsx', function ($shipment) {
            return [
                'Contact' => $shipment->customer_name,
                'Entreprise' => $shipment->company,
                'Email' => $shipment->email,
                'Numéro de téléphone' => $shipment->phone_number,
                'Moyen' => $shipment->medium_name === 'air' ? 'Aérien' : ($shipment->medium_name === 'sea' ? 'Maritime' : ($shipment->medium_name === 'road' ? 'Routier' : '')),
                'Port de départ' => $shipment->departure_port,
                "Port d'arrivée" => $shipment->arrival_port,
                'Date de départ' => Carbon::parse($shipment->departure_date)->format('m-d-Y'),
                "Date d'arrivée" => Carbon::parse($shipment->arrival_date)->format('m-d-Y'),
                'Ajouté par' => $shipment->user_name,
            ];
        });
    }

    // ports
    public function portsList()
    {
        $ports = DB::table('ports')->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($ports))->download('liste_ports_' . $timestamp . '.xlsx', function ($port) {
            return [
                'Nom du port' => $port->port_name,
                'Lieu' => $port->location,
            ];
        });
    }

    // equipments
    public function equipmentsList()
    {
        $equipments = DB::table('equipment_names')->get();

        $timestamp = Carbon::now()->format('d_m_Y');

        return (new FastExcel($equipments))->download('liste_equipments_' . $timestamp . '.xlsx', function ($equipment) {
            return [
                "Nom de l'Équipement" => $equipment->equipment_name,
                'Type' => $equipment->type === 'maritime' ? 'Maritime' : ($equipment->type === 'road' ? 'Routier' : ''),
                'Description' => $equipment->description,
            ];
        });
    }
}
