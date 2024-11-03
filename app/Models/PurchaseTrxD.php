<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTrxD extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'ingredient_amt',
        'ingredient_name',
        'notes',
        'purchase_trx_h_id',
    ];

    public function Ingredient(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function PurchaseTrxH(){
        return $this->belongsTo(PurchaseTrxH::class, 'purchase_trx_h_id');
    }

}
