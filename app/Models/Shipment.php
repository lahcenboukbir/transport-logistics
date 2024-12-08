<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = "shipments";

    protected $fillable = [
        'consultation_id',
        'departure_port_id',
        'arrival_port_id',
        'departure_date',
        'arrival_date',
        'notes',
        'medium_name',
        'quantity',
        'tracking_number',
        'status',
        'delayed_reason',
        'selling_price',
        'buying_price',
        'agent_commission'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function departurePort()
    {
        return $this->belongsTo(Port::class, 'departure_port_id');
    }

    public function arrivalPort()
    {
        return $this->belongsTo(Port::class, 'arrival_port_id');
    }

    public function airEquipment()
    {
        return $this->hasOne(AirEquipment::class);
    }

    public function seaEquipment()
    {
        return $this->hasOne(MaritimeEquipment::class);
    }

    public function roadEquipment()
    {
        return $this->hasOne(RoadEquipment::class);
    }
}
