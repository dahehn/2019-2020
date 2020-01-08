<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location=Location::all();
        return response()->json($location,200);
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
            $location = new Location();
            $location->id = $request->id;
            $this->validate($request,[
                'name' => 'required',
            ]);
            $location->name = $request->name;
            $location->save();
            return response()->json('Stored',201);
        }
        catch (Exception $ex)
        {
            return response()->json('Unsuccessful',200);
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
            $location = Location::find($id);
            $this->validate($request,[
                'name' => 'required',
            ]);
            $location->name = $request->name;
            $location->save();
            return response()->json('Successful', 201);
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
        $location = Location::find($id);

        // cheap way: don't delete any subject with attached teachers
        if ($location != null && count($location->devices) == 0) {
            Location::destroy($id);
            return response(Location::all(),200);
        }
        else {
            return response()->json('Unsuccessful',420);
        }
    }
}
