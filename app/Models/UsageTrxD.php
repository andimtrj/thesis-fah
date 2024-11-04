<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageTrxD extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_amt',
        'product_name',
        'notes',
        'usage_trx_h_id'
    ];

    public function Products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function UsageTrxH(){
        return $this->belongsTo(UsageTrxH::class, 'usage_trx_h_id');
    }

    public function UsageTrxDAlloc()
    {
        return $this->hasMany(UsageTrxDAlloc::class, 'usage_trx_d_id');
    }
}
