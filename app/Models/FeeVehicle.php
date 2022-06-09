<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeVehicle extends Model
{
    use HasFactory;
    protected $fillable = ['fee_id', 'vehicle_id', 'price', 'detail', 'status'];
}
