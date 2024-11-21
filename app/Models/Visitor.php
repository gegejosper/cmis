<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'address',
        'date_in', 
        'time_in',
        'deceased_id'
    ];

    public function deceased_details(){
        return $this->belongsTo('App\Models\Deceased', 'deceased_id', 'id');
    }
}
