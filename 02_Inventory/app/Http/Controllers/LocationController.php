<?php

namespace App\Http\Controllers;

use App\Device;
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
        return view('locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
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
        $location = Location::find($id);

        if ($location != null) {
            return view('locations.edit')->with('location', $location);
        }
        else {
            return redirect()->route('locations.index')
                ->withErrors('Location with id=' . $id . ' not found!');
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
            $location = Location::find($id);
            $this->validate($request,[
                'name' => 'required',
            ]);
            $location->name = $request->name;
            $location->save();
            return view('locations.edit')->with('location', $location);
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
        $location = Location::find($id);

        // cheap way: don't delete any subject with attached teachers
        if ($location != null && count($location->devices) == 0) {
            Location::destroy($id);
            return redirect()->route('locations.index');
        }
        else {
            return view('locations.edit')->with('location',$location) ->withErrors('Unable to delete Location is not empty');
        }
    }


}
