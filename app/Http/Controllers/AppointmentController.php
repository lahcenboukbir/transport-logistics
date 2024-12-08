<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display appointments|create apppointments|view apppointments|delete apppointments', ['only' => ['index']]);
        $this->middleware('permission:create appointments', ['only' => ['create', 'store']]);
        $this->middleware('permission:view appointments', ['only' => ['show']]);
        $this->middleware('permission:edit appointments', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete appointments', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = DB::table('appointments')
            ->join('prospects', 'appointments.prospect_id', 'prospects.id')
            ->select('prospects.id', 'prospects.name', 'prospects.company', 'prospects.next_followup_date', DB::raw('COUNT(appointments.id) as total_appointments'))
            ->groupBy('prospects.id', 'prospects.name', 'prospects.company', 'prospects.next_followup_date')
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->next_followup_date = Carbon::parse($appointment->next_followup_date)->format('d/m/Y - H:m');
        }

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prospects = DB::table('prospects')->select('id', 'name')->get();

        return view('appointments.create', compact('prospects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prospect_id' => 'required|exists:prospects,id',
            'appointment_date' => 'required|date',
        ]);

        $prospect = Prospect::find($validated['prospect_id']);

        if ($prospect->next_followup_date < $validated['appointment_date']) {
            Appointment::create([
                'prospect_id' => $validated['prospect_id'],
                'appointment_date' => $validated['appointment_date'],
                'user_id' => auth()->id(),
            ]);

            // Update the 'next_followup_date' column
            $prospect->update([
                'next_followup_date' => $validated['appointment_date']
            ]);

            return redirect()->route('appointments.index')->with('success', 'Rendez-vous créé avec succès !');
        } else {
            return redirect()->route('appointments.create')->with('error', 'La date du rendez-vous doit être postérieure au ' . Carbon::parse($prospect->next_followup_date)->format('d/m/Y') . ' à ' . Carbon::parse($prospect->next_followup_date)->format('H:m'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointments = DB::table('appointments')->where('prospect_id', $id)->orderBy('appointment_date', 'desc')->get();

        return view('appointments.show', compact('appointments'));
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
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'outcome' => 'nullable|in:pending,success,fail',
            'duration' => 'nullable|string',
            'notes' => 'nullable|string',
            'location' => 'nullable|string'
        ]);

        $appointment = Appointment::find($id);
        $appointment->update($validated);

        if ($validated['outcome'] === 'success') {
            Prospect::where('id', $appointment->prospect_id)->update([
                'status' => 'customer'
            ]);

            Customer::create([
                'prospect_id' => $appointment->prospect_id,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('customers.index')->with('success', 'Client créé avec succès !');
        }

        if ($validated['outcome'] === 'fail') {
            Prospect::where('id', $appointment->prospect_id)->update([
                'status' => 'not interested'
            ]);
        }

        return redirect()->route('appointments.show', $appointment->prospect_id)->with('success', 'Rendez-vous mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            $appointment->delete();

            return redirect()->route('appointments.show', $appointment->prospect_id)->with('success', 'Rendez-vous supprimé avec succès !');
        }
    }
}
