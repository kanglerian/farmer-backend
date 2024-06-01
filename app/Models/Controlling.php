<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controlling extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'duration',
        'status',
        'id_sub_device',
    ];

    public function controlling(){
        return $this->belongsTo(Device::class,'id_sub_device','id');
    }

    public function detailcontrolling(){
        return $this->hasMany(DetailControlling::class, 'id_controlling');
    }
}
