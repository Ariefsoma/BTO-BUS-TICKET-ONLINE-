<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // <-- perbaikan: gunakan properti $casts (bukan method)
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // +++ tambahkan relasi bookings +++
    public function bookings()
    {
        // Booking::class akan di-resolve; pastikan App\Models\Booking ada
        return $this->hasMany(\App\Models\Booking::class, 'user_id', 'id');
    }

    // opsional: relasi lain (jika perlu)
    // public function payments() { return $this->hasMany(\App\Models\Payment::class, 'user_id', 'id'); }
}
