<?php

namespace App\Http\Controllers\API;

use App\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices=Device::all();
        return response()->json($devices,200);
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
            $location=Location::find($request->get('location'));
            $device->location()->associate($location);
            $device->save();
            return response()->json('Successfully created device',201);
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
            return response()->json('Successfully updated',200);
        }
        catch (Exception $ex)
        {
            return response()->json('Unsuccessful',200);
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
            return response()->json('Successful', 200);
        }
        else {
            return response()->json('Unsuccessful ', 200);
        }
    }
}
