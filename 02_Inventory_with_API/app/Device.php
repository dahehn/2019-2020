<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function location() {
        return $this->belongsTo('App\Location');
    }
    public function isBorrowed($id){
        $device=Device::find($id);
        if($device->borrowed==0)
            return 'yes';
        else
            return 'no';
    }
}
