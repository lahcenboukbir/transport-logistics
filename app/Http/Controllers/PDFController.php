<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
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

        foreach ($users as $user) {
            $user->is_active = $user->is_active === 1 ? 'Actif' : 'Inactif';
            $user->created_at = Carbon::parse($user->created_at)->format('m/d/Y');
        }

        $pdf = Pdf::loadView('pdf.users.list', compact('users'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_utilisateurs_' . $timestamp . '.pdf');
    }

    public function usersStatistics()
    {
        $users = DB::table('users')
            ->select(
                'users.name',
                DB::raw('(SELECT COUNT(*) FROM prospects WHERE prospects.user_id = users.id) as total_prospects'),
                DB::raw('(SELECT COUNT(*) FROM customers WHERE customers.user_id = users.id) as total_customers'),
                DB::raw('(SELECT COUNT(*) FROM appointments WHERE appointments.user_id = users.id) as total_appointments'),
                DB::raw('(SELECT COUNT(*) FROM consultations WHERE consultations.user_id = users.id) as total_consultations'),
            )
            ->groupBy('users.id', 'users.name')
            ->get();

        foreach ($users as $user) {
            $user->conversion_rate = $user->total_customers > 0
                ? ($user->total_customers / $user->total_prospects) * 100
                : 0;

            $user->conversion_rate2 = $user->total_consultations > 0
                ? ($user->total_consultations / $user->total_prospects) * 100
                : 0;
        }

        $pdf = Pdf::loadView('pdf.users.statistics', compact('users'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('statistiques_utilisateurs_' . $timestamp . '.pdf');
    }

    // prospects
    public function prospectsList()
    {
        $prospects = DB::table('prospects')
            ->join('users', 'prospects.user_id', 'users.id')
            ->select('prospects.*', 'users.name as user_name')
            ->where('status', '!=', 'customer')
            ->get();
        foreach ($prospects as $prospect) {
            $prospect->created_at = Carbon::parse($prospect->created_at)->format('m/d/Y');
        }

        $pdf = PDF::loadView('pdf.prospects.list', compact('prospects'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_prospects_' . $timestamp . '.pdf');
    }

    public function prospectsStatistics()
    {
        $prospects = DB::table('prospects')
            ->select('prospects.*', DB::raw('(SELECT COUNT(*) FROM appointments WHERE appointments.prospect_id = prospects.id AND prospects.status != "customer") as total_appointments'))
            ->where('status', '!=', 'customer')
            ->get();

        $new_prospects = DB::table('prospects')->where('status', 'new')->get();
        $interested_prospects = DB::table('prospects')->where('status', 'interested')->get();
        $not_interested_prospects = DB::table('prospects')->where('status', 'not interested')->get();

        $pdf = PDF::loadView('pdf.prospects.statistics', compact('prospects', 'new_prospects', 'interested_prospects', 'not_interested_prospects'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('statistiques_prospects_' . $timestamp . '.pdf');
    }

    // customers
    public function customersList()
    {
        $customers = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->join('users', 'customers.user_id', 'users.id')
            ->select('customers.*', 'prospects.*', 'users.name as user_name')
            ->get();

        foreach ($customers as $customer) {
            $customer->created_at = Carbon::parse($customer->created_at)->format('m/d/Y');
        }

        $pdf = PDF::loadView('pdf.customers.list', compact('customers'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_clients_' . $timestamp . '.pdf');
    }

    public function customersStatistics()
    {
        $customers = DB::table('prospects')
            ->select('prospects.*', DB::raw('(SELECT COUNT(*) FROM appointments WHERE appointments.prospect_id = prospects.id AND prospects.status = "customer") as total_appointments'))
            ->get();

        $pdf = PDF::loadView('pdf.customers.statistics', compact('customers'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('statistiques_customers_' . $timestamp . '.pdf');
    }

    // appointments
    public function appointmentsList()
    {
        $appointments = DB::table('appointments')
            ->join('prospects', 'appointments.prospect_id', 'prospects.id')
            ->join('users', 'appointments.user_id', 'users.id')
            ->select('prospects.name', 'prospects.company', 'prospects.phone_number', 'appointments.*', 'users.name as user_name')
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('d/m/Y - H:m');
        }

        $pdf = PDF::loadView('pdf.appointments.list', compact('appointments'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_rendez_vous_' . $timestamp . '.pdf');
    }

    public function appointmentsStatistics()
    {
        function appointments($outcome)
        {
            $appointments = DB::table('appointments')
                ->join('prospects', 'appointments.prospect_id', 'prospects.id')
                ->join('users', 'appointments.user_id', 'users.id')
                ->select('prospects.name', 'prospects.company', 'prospects.phone_number', 'appointments.*', 'users.name as user_name')
                ->where('appointments.outcome', $outcome)
                ->get();

            foreach ($appointments as $appointment) {
                $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('d/m/Y - H:m');
            }

            return $appointments;
        }

        $success_appointments = appointments('success');
        $fail_appointments = appointments('fail');

        $pdf = PDF::loadView('pdf.appointments.statistics', compact('success_appointments', 'fail_appointments'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_rendez_vous_' . $timestamp . '.pdf');
    }

    // consultations
    public function consultationsList()
    {
        $consultations = DB::table('consultations')
            ->join('users', 'consultations.user_id', 'users.id')
            ->join('customers', 'consultations.customer_id', 'customers.id')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select('consultations.*', 'users.name as user_name', 'prospects.name as customer_name', 'prospects.company', 'prospects.phone_number')
            ->get();

        foreach ($consultations as $consultation) {
            $consultation->confirmation_date = $consultation->confirmation_date ? Carbon::parse($consultation->confirmation_date)->format('m/d/Y') : null;
            $consultation->consultation_date = Carbon::parse($consultation->consultation_date)->format('m/d/Y');
        }

        $pdf = PDF::loadView('pdf.consultations.list', compact('consultations'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_consultations_' . $timestamp . '.pdf');
    }

    // public function consultationsStatistics()
    // {
    //     function consultations($status)
    //     {
    //         $consultations = DB::table('consultations')
    //             ->join('users', 'consultations.user_id', 'users.id')
    //             ->join('customers', 'consultations.customer_id', 'customers.id')
    //             ->join('prospects', 'customers.prospect_id', 'prospects.id')
    //             ->select('consultations.*', 'users.name as user_name', 'prospects.name as customer_name', 'prospects.company', 'prospects.phone_number')
    //             ->where('consultations.status', $status)
    //             ->get();

    //         foreach ($consultations as $consultation) {
    //             $consultation->confirmation_date = $consultation->confirmation_date ? Carbon::parse($consultation->confirmation_date)->format('m/d/Y') : null;
    //             $consultation->consultation_date = Carbon::parse($consultation->consultation_date)->format('m/d/Y');
    //         }

    //         return $consultations;
    //     }

    //     $completed_consultations = consultations('completed');
    //     $canceled_consultations = consultations('canceled');

    //     $pdf = PDF::loadView('pdf.consultations.statistics', compact('completed_consultations', 'canceled_consultations'));
    //     $timestamp = Carbon::now()->format('d_m_Y');

    //     return $pdf->stream('liste_consultations_' . $timestamp . '.pdf');
    // }

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
                'prospects.phone_number'
            )
            ->get();

        foreach ($shipments as $shipment) {
            $shipment->departure_date = Carbon::parse($shipment->departure_date)->format('m/d/Y');
            $shipment->arrival_date = Carbon::parse($shipment->arrival_date)->format('m/d/Y');
            $shipment->medium_name = $shipment->medium_name === 'air' ?  'Aérien' : ($shipment->medium_name === 'maritime' ?  'Maritime' : ($shipment->medium_name === 'road' ?  'Routier' : ''));
        }

        $pdf = PDF::loadView('pdf.shipments.list', compact('shipments'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_expéditions_' . $timestamp . '.pdf');
    }

    // ports
    public function portsList()
    {
        $ports = DB::table('ports')->get();

        $pdf = PDF::loadView('pdf.ports.list', compact('ports'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_ports_' . $timestamp . '.pdf');
    }

    // equipments
    public function equipmentsList()
    {
        $equipments = DB::table('equipment_names')->get();

        foreach ($equipments as $equipment) {
            $equipment->type = $equipment->type === 'maritime' ? 'Maritime' : ($equipment->type === 'road' ? 'Routier' : '');
        }

        $pdf = PDF::loadView('pdf.equipments.list', compact('equipments'));
        $timestamp = Carbon::now()->format('d_m_Y');

        return $pdf->stream('liste_equipements_' . $timestamp . '.pdf');
    }
}
