<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeasingDetail extends Model
{

    use HasFactory;
    protected $table = "leasing_details";
    protected $guarded = [];

    public function leasing(){
        return $this->belongsTo(Leasing::class,'leasing_id','id');
    }
}
