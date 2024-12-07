<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graveyard extends Model
{
    use HasFactory;
    protected $fillable = [
        'graveyard_name',
        'block_numbers',
        'status',
        'graveyard_image'
    ];

    public function block_details(){
        return $this->hasMany('App\Models\Block', 'graveyard_id', 'id');
    }
}
