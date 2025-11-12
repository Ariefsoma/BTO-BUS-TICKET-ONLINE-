<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';
    protected $primaryKey = 'route_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['origin', 'destination', 'distance', 'duration'];

    public function buses()
    {
        return $this->hasMany(Bus::class, 'route_id', 'route_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'route_id', 'route_id');
    }
}
