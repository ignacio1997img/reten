<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_id', 'user_id', 'status'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
