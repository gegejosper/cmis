<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'dob',
        'dod',
        'date_of_birth', 
        'block_id',
        'graveyard_id'
    ];

    public function block_details(){
        return $this->belongsTo('App\Models\Block', 'block_id', 'id');
    }
    public function graveyard_details(){
        return $this->belongsTo('App\Models\Graveyard', 'graveyard_id', 'id');
    }
}
