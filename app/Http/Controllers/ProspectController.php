<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProspectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display prospects|create prospects|view prospects|edit prospects|delete prospects|manage status prospects', ['only' => ['index']]);
        $this->middleware('permission:create prospects', ['only' => ['create', 'store']]);
        $this->middleware('permission:view prospects', ['only' => ['show']]);
        $this->middleware('permission:edit prospects', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete prospects', ['only' => ['destroy']]);
        $this->middleware('permission:manage status prospects', ['only' => ['status']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prospects = DB::table('prospects')
            ->select('id', 'name', 'company', 'phone_number', 'status')
            ->where('status', '!=', 'customer')
            ->get();

        return view('prospects.index', compact('prospects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prospects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'ice' => 'nullable|string|max:255',
            'email' => 'required|email|unique:prospects,email|max:255',
            'phone_number' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'status' => 'nullable|in:new,interested,not interested,customer',
            'notes' => 'nullable|string|max:255',

            'appointment_date' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['next_followup_date'] = $validated['appointment_date'];

        // Create the prospect
        $prospect = Prospect::create($validated);

        // Create the appointment
        Appointment::create([
            'prospect_id' => $prospect->id,
            'appointment_date' => $validated['appointment_date'],
            'user_id' => $validated['user_id'],
        ]);

        // Create the customer
        if ($validated['status'] === 'customer') {
            Customer::create([
                'prospect_id' => $prospect->id,
                'user_id' => $validated['user_id'],
            ]);

            Appointment::where('prospect_id', $prospect->id)->update([
                'outcome' => 'success'
            ]);

            return redirect()->route('customers.index')->with('success', 'Client créé avec succès !');
        }

        return redirect()->route('prospects.index')->with('success', 'Prospect créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prospect = DB::table('prospects')->where('id', $id)->first();
        $prospect->created_at = Carbon::parse($prospect->created_at)->format('d/m/Y');

        $created_by = DB::table('prospects')
            ->join('users', 'prospects.user_id', 'users.id')
            ->select('users.*')
            ->where('prospects.id', $id)
            ->first();

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.user_id', 'users.id')
            ->select('appointments.*', 'users.name as user_name')
            ->where('appointments.prospect_id', $id)
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('d/m/Y - H:m');
        }

        return view('prospects.show', compact('prospect', 'created_by', 'appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prospect = DB::table('prospects')->where('id', $id)->first();

        return view('prospects.edit', compact('prospect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'ice' => 'nullable|string|max:255',
            'email' => ['required', 'email', 'unique:prospects,email,' . $id],
            'phone_number' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'status' => 'nullable|in:new,interested,not interested,customer',
            'notes' => 'nullable|string|max:255',
        ]);

        $prospect = Prospect::find($id);

        // Update the prospect
        $prospect->update($validated);

        // Create a customer
        // if ($validated['status'] === 'customer' && !$prospect->customer) {
        if ($validated['status'] === 'customer') {
            Customer::create([
                'prospect_id' => $prospect->id,
                'user_id' => auth()->id(),
            ]);

            // Update the last appointment to 'success' if the prospect becomes a customer
            $appointment = Appointment::where('prospect_id', $prospect->id)
                ->orderBy('appointment_date', 'desc')
                ->first();

            $appointment->update([
                'outcome' => 'success'
            ]);

            return redirect()->route('customers.index')->with('success', 'Client créé avec succès !');
        }

        return redirect()->route('prospects.edit', $id)->with('success', 'Prospect mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prospect = Prospect::find($id);

        if ($prospect) {
            $prospect->delete();

            return redirect()->route('prospects.index')->with('success', 'Prospect supprimé avec succès !');
        }
    }

    /**
     * Status
     */

    public function status(Request $request,  string $id)
    {
        $validated = $request->validate([
            'status' => 'nullable|in:new,interested,not interested,customer',
        ]);

        $prospect = Prospect::find($id);

        if ($validated['status'] === 'customer') {
            $prospect->update([
                'status' => $validated['status']
            ]);

            Customer::create([
                'prospect_id' => $prospect->id,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('customers.index')->with('success', 'Client créé avec succès !');
        } else {
            $prospect->update([
                'status' => $validated['status']
            ]);

            return redirect()->route('prospects.index')->with('success', 'Statut du prospect mis à jour avec succès !');
        }
    }
}
