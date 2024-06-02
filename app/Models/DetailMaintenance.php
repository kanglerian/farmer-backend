<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMaintenance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_maintenance',
        'detail',
        'cost'
    ];

    protected $table = 'detail_maintenance';

    public function maintenance(){
        return $this->belongsTo(Maintenance::class,'id_maintenance','id');
    }
}
