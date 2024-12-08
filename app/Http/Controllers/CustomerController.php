<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display customers|assign customers|view customers|delete customers', ['only' => ['index']]);
        $this->middleware('permission:assign customers', ['only' => ['store']]);
        $this->middleware('permission:view customers', ['only' => ['show']]);
        $this->middleware('permission:delete customers', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->select('customers.*', 'prospects.name', 'prospects.company', 'prospects.phone_number')
            ->get();

        $prospects = DB::table('prospects')->where('status', '!=', 'customer')->select('id', 'name')->get();

        return view('customers.index', compact('customers', 'prospects'));
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
        $validated = $request->validate([
            'prospect_id' => 'required|exists:prospects,id',
        ]);

        Prospect::where('id', $validated['prospect_id'])->update([
            'status' => 'customer'
        ]);

        Customer::create([
            'prospect_id' => $validated['prospect_id'],
            'user_id' => auth()->id(),
        ]);

        // Update the last appointment
        $appointment = Appointment::where('prospect_id', $validated['prospect_id'])->orderBy('appointment_date', 'desc')->first();
        $appointment->update([
            'outcome' => 'success'
        ]);

        return redirect()->route('customers.index')->with('success', 'Client créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = DB::table('customers')
            ->join('prospects', 'customers.prospect_id', 'prospects.id')
            ->where('customers.id', $id)
            ->first();
        $customer->created_at = Carbon::parse($customer->created_at)->format('m/d/Y');

        $created_by = DB::table('customers')
            ->join('users', 'customers.user_id', 'users.id')
            ->select('users.id', 'users.name')
            ->where('customers.id', $id)
            ->first();

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.user_id', 'users.id')
            ->select('appointments.*', 'users.name as user_name')
            ->where('appointments.prospect_id', $id)
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('d/m/Y - H:m');
        }

        return view('customers.show', compact('customer', 'created_by', 'appointments'));
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
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();

            Prospect::where('id', $customer->prospect_id)->update([
                'status' => 'new'
            ]);

            return redirect()->route('customers.index')->with('success', 'Client supprimé avec succès !');
        }
    }
}
