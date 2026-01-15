<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings,key',
            'value' => 'required',
            'type' => 'required|in:string,integer,decimal,boolean,json',
            'description' => 'nullable|string',
        ]);

        Setting::create($request->all());

        return redirect()->back()->with('success', 'Setting created successfully!');
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'value' => 'required',
        ]);

        $setting->update(['value' => $request->value]);

        return redirect()->back()->with('success', 'Setting updated successfully!');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect()->back()->with('success', 'Setting deleted successfully!');
    }
}
