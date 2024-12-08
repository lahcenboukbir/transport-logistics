<?php

namespace App\Http\Controllers;

use App\Models\EquipmentName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display equipments|create equipments|edit equipments|delete equipments', ['only' => ['index']]);
        $this->middleware('permission:create equipments', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit equipments', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete equipments', ['only' => ['destory']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = DB::table('equipment_names')->get();

        return view('equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_name' => 'required|string|max:255',
            'type' => 'required|in:road,maritime',
            'description' => 'nullable|string|max:255',
        ]);

        EquipmentName::create($validated);

        return redirect()->route('equipments.index')->with('success', 'Équipement créé avec succès !');
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
        $equipment = DB::table('equipment_names')->where('id', $id)->first();

        return view('equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'equipment_name' => 'required|string|max:255',
            'type' => 'required|in:road,maritime',
            'description' => 'nullable|string|max:255',
        ]);

        $equipment = EquipmentName::find($id);

        $equipment->update($validated);

        return redirect()->route('equipments.edit', $id)->with('success', 'Équipement mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = EquipmentName::find($id);

        if ($equipment) {
            $equipment->delete();

            return redirect()->route('equipments.index')->with('success', 'Équipement supprimé avec succès !');
        }
    }
}
