<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_name',
        'graveyard_id',
        'deceased_id',
        'status'
    ];
    public function deceased_details(){
        return $this->belongsTo('App\Models\Deceased', 'id', 'block_id');
    }
}
