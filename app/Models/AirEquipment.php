<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirEquipment extends Model
{
    use HasFactory;

    protected $table = "air_equipments";

    protected $fillable = [
        'shipment_id',
        'volume',
        'weight'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
