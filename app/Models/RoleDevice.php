<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleDevice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_device_master',
        'id_user',
    ];

    protected $table = 'role_devices';

    public function users(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function devices(){
        return $this->belongsTo(Device::class,'id_device_master','id');
    }

    public function detailroledevice()
    {
        return $this->hasMany(DetailRoleDevice::class, 'id_role');
    }
}
