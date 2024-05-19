<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdevice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'location',
        'id_device',
        'condition'
    ];

    protected $table = 'subdevice';

    public function device()
    {
        return $this->belongsTo(Device::class, 'id_device', 'id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'id_subdevice', 'id');
    }
}
