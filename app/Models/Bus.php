<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'buses';
    protected $primaryKey = 'bus_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'bus_name',
        'route_id',
        'bus_type',
        'seat_count',
        'price_per_seat',
        'status',
        'plate_number',
        'image',
        'pickup_point',
        'dropoff_point',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'route_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'bus_id', 'bus_id');
    }
}
