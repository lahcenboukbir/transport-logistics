<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $table = "prospects";

    protected $fillable = [
        'name',
        'company',
        'ice',
        'email',
        'phone_number',
        'status',
        'city',
        'activity',
        'notes',
        'next_followup_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
