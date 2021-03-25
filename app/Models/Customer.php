<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "customers";
    protected $guarded = [];

    public function cnicImg()
    {
        return $this->hasOne('App\Models\Image','cnic_image');
    }

}
