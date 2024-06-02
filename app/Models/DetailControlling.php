<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailControlling extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_controlling',
        'temperature',
        'watt',
    ];
    protected $table = 'detail_controlling';

    public function controlling(){
        return $this->belongsTo(Controlling::class,'id_controlling','id');
    }
}
