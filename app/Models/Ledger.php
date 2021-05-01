<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany('App\Models\LedgerDetails','ledger_id');
    }


}
