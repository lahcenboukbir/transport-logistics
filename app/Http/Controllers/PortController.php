<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display ports|create ports|edit ports|delete ports', ['only' => ['index']]);
        $this->middleware('permission:create ports', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit ports', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete ports', ['only' => ['destory']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ports = DB::table('ports')->get();

        return view('ports.index', compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'port_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255'
        ]);

        Port::create($validated);

        return redirect()->route('ports.index')->with('success', 'Port créé avec succès !');
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
        $port = DB::table('ports')->where('id', $id)->first();
        // dd($port);

        return view('ports.edit', compact('port'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'port_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255'
        ]);

        $port = Port::find($id);
        $port->update($validated);

        return redirect()->route('ports.edit', $id)->with('success', 'Port mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $port = Port::find($id);

        if ($port) {
            $port->delete();

            return redirect()->route('ports.index')->with('success', 'Port supprimé avec succès !');
        }
    }
}
