<?php

namespace App\Http\Controllers;

use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appName = GeneralSettings::pluck('app_name');
        
        return view('settings.general.index', compact('appName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function UpdateDetails(Request $request)
    {
        // Favicon update
        if (!empty($request->favicon)) {
            $setting = GeneralSettings::where('favicon', 'favicon.png')->first();
            $request->validate([
                'favicon' => 'mimes:png|required',
            ]);

            if (!empty($setting->favicon)) {
                unlink(public_path('/images/favicon.png'));
            }

            $image_name = "favicon.png";
            $request->favicon->move(public_path('/images'), $image_name);
            $setting->favicon = $image_name;

            $setting->update();

            return redirect()->back()->with('success', 'Favicon Updated Successfully');
        }
        // Logo Update
        if (!empty($request->logo)) {
            $setting = GeneralSettings::first();
            $request->validate([
                'logo' => 'mimes:png|required',
            ]);

            if (!empty($setting->logo)) {
                unlink(public_path('/images/logo.png'));
            }

            $image_name = "logo.png";
            $request->logo->move(public_path('/images'), $image_name);
            $setting->logo = "logo.png";

            $setting->update();

            return redirect()->back()->with('success', 'Logo Updated Successfully');
        }
        // dd($request->app_name);
        // Application name update
        if ($request->app_name != null) {
            $setting = GeneralSettings::first();
            $request->validate([
                'app_name' => 'required',
            ]);
            $setting->app_name = $request->app_name;

            $setting->update();

            return redirect()->route('general-settings.index')->with('success', 'Application Name Updated Successfully');
        }

        return redirect()->back()->with('error', 'Choose one update');
    }
}
