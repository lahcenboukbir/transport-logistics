<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadEquipment extends Model
{
    use HasFactory;

    protected $table = "road_equipments";

    protected $fillable = [
        'shipment_id',
        'equipment_name_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function equipmentName()
    {
        return $this->belongsTo(EquipmentName::class);
    }
}
