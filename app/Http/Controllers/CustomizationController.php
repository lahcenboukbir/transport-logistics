<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display customizations|edit logo customizations|edit name customizations', ['only' => ['logo', 'name']]);
        $this->middleware('permission:edit logo customizations', ['only' => ['logoUpdate']]);
        $this->middleware('permission:edit name customizations', ['only' => ['nameUpdate']]);
    }

    // logo
    public function logo()
    {
        $logo = DB::table('customizations')->where('name', 'logo')->first();
        $logo_sm = DB::table('customizations')->where('name', 'logo_sm')->first();

        return view('customizations.logo', compact('logo', 'logo_sm'));
    }

    public function logoUpdate(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_sm' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logo = DB::table('customizations')->where('name', 'logo')->first();
        $logo_sm = DB::table('customizations')->where('name', 'logo_sm')->first();

        if ($request->hasFile('logo')) {
            if ($logo->value) {
                Storage::delete($logo->value);
            }

            $validated['logo'] = $request->file('logo')->store('images', 'public');
        }

        if ($request->hasFile('logo_sm')) {
            if ($logo_sm->value) {
                Storage::delete($logo_sm->value);
            }

            $validated['logo_sm'] = $request->file('logo_sm')->store('images', 'public');
        }

        if ($request->logo) {
            Customization::where('name', 'logo')->update([
                'value' => $validated['logo']
            ]);
        }

        if ($request->logo_sm) {
            Customization::where('name', 'logo_sm')->update([
                'value' => $validated['logo_sm']
            ]);
        }

        return redirect()->route('logo')->with('success', 'Logo mis à jour avec succès !');
    }

    // name
    public function name()
    {
        $site_name = DB::table('customizations')->where('name', 'site_name')->first();

        return view('customizations.name', compact('site_name'));
    }

    public function nameUpdate(Request $request)
    {

        $validated = $request->validate([
            'value' => 'nullable|string',
        ]);


        Customization::where('name', 'site_name')->update([
            'value' => $validated['value']
        ]);

        return redirect()->route('name')->with('success', 'Nom mis à jour avec succès !');
    }
}
