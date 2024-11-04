<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentTrxD extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'ingredient_amt',
        'ingredient_name',
        'notes',
        'adjustment_trx_h_id',
    ];

    public function Ingredient(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function AdjustmentTrxH(){
        return $this->belongsTo(AdjustmentTrxH::class, 'adjustment_trx_h_id');
    }

}
