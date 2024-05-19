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
        'id_subdevice',
        'problem',
        'cost',
    ];

    protected $table = 'maintenance';

    public function subdevice()
    {
        return $this->belongsTo(Subdevice::class, 'id_subdevice', 'id');
    }
}
