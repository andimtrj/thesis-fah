<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageTrxDAlloc extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'ingredient_amt',
        'ingredient_name',
        'usage_trx_d_id'
    ];

    public function Ingredient(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function UsageTrxD(){
        return $this->belongsTo(UsageTrxD::class, 'usage_trx_d_id');
    }
}
