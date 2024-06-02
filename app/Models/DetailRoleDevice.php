<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRoleDevice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_role',
        'id_sub_device',
        'status',
    ];
    protected $table = 'detail_role_devices';

    public function detailroledevice(){
        return $this->belongsTo(Device::class,'id_sub_device','id');
    }

    public function roledevice(){
        return $this->belongsTo(RoleDevice::class,'id_role','id');
    }
}
