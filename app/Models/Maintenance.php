<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'maintenance',
        'id_user',
        'id_device'
    ];

    protected $table = 'maintenances';

    public function detailmaintenance(){
        return $this->hasMany(DetailMaintenance::class, 'id_maintenance');
}

    public function users(){
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function devices(){
        return $this->belongsTo(Device::class,'id_device','id');
    }
}
