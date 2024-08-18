<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function table(){
        return $this->belongsTo(Table::class);
    }
}
