<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function devices() {
        return $this->hasMany('App\Device');
    }
    public function getDeviceNumber($id)
    {
        return count(Device::all()->where('location_id',$id));
    }
    public function getDevices($id)
    {
        return Device::all()->where('location_id',$id);
    }
}
