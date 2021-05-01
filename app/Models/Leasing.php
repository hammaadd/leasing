<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leasing extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "leasings";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class,'product_id');
    }

    public function details(){
        return $this->hasMany(LeasingDetail::class,'leasing_id','id');
    }
}
