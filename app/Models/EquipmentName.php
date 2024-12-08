<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentName extends Model
{
    use HasFactory;

    protected $table = "equipment_names";

    protected $fillable = [
        'equipment_name',
        'type',
        'description'
    ];

    public function seaEquipments()
    {
        return $this->hasMany(MaritimeEquipment::class);
    }

    public function roadEquipments()
    {
        return $this->hasMany(RoadEquipment::class);
    }
}
