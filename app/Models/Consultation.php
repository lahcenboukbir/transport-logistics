<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = "consultations";

    protected $fillable = [
        'customer_id',
        'user_id',
        'status',
        'notes',
        'confirmation_date',
        'consultation_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shipments()
    {
        return $this->hasOne(Shipment::class);
    }

    // public function shipments()
    // {
    //     return $this->hasMany(Shipment::class);
    // }
}
