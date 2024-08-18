<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    public function reservation (){
        return $this->belongsTo(Reservation::class);
    }

    public function table(){
        return $this->belongsTo(Table::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
