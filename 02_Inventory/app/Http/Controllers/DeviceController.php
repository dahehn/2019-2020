<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Location;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $device = new Device();
            $device->id = $request->id;
            $this->validate($request,[
                'vendor' => 'required',
                'model' => 'required',
                'year'=>'required',
            ]);
            $device->vendor = $request->vendor;
            $device->model = $request->model;
            $device->year = $request->year;
            $device->borrowed = false;
            $location=\App\Location::find($request->get('location'));
            $device->location()->associate($location);
            $device->save();
            return redirect()->route('locations.index');
        }
        catch (Exception $ex)
        {
            return redirect()->route('location.create')->withErrors("Cannot create because of error: " . $ex. "!");
        }
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
        $device = Device::find($id);

        if ($device != null) {
            return view('devices.edit')->with('device', $device);
        }
        else {
            return redirect()->route('locations.edit')
                ->withErrors('Device with id=' . $id . ' not found!');
        }
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
        try
        {
            $device = Device::find($id);
            if(!$request->model==null)
                $device->model = $request->model;
            if(!$request->vedor==null)
                $device->vendor=$request->vendor;
            if(!$request->year==null)
                $device->year=$request->year;
            if($request->borrowed==true)
                $device->borrowed=true;
            else
                $device->borrowed=false;
            $device->location_id=$request->location_id;
            $device->save();
            return view('locations.index');
        }
        catch (Exception $ex)
        {
            return redirect()->route('location.edit')->withErrors("Cannot edit because of error: " . $ex. "!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        if ($device != null) {
            Device::destroy($id);
            return redirect()->route('locations.index');
        }
        else {
            return view('locations.index') ->withErrors('Unable to delete this device, device not found');
        }
    }
}
