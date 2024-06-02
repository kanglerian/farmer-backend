<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'coordinate_device_x',
        'coordinate_device_y',
        'status',
        'condition',
    ];
    protected $table = 'devices';

    public function roledevice(){
        return $this->hasMany(RoleDevice::class, 'id_device_master');
    }

    public function detailroledevice(){
        return $this->hasMany(DetailRoleDevice::class, 'id_sub_device');
    }
}
