<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = "images";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','cnic_image');
    }
}
