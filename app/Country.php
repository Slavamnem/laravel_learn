<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = "country";

    public function user(){
        return $this->belongsTo("App\User", 'user_id', 'id');
    }
}
