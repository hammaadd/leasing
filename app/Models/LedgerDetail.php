<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LedgerDetail extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function ledger(){
       $this->belongsTo(Ledger::class, 'ledger_id');
    }
}
