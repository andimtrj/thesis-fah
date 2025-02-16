<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model
{
    use HasFactory;

    public function AdjustmentTrxH() : HasMany
    {
        return $this->hasMany(AdjustmentTrxH::class);
    }

    public function PurchaseTrxH() : HasMany
    {
        return $this->hasMany(PurchaseTrxH::class);
    }

    public function UsageTrxH() : HasMany
    {
        return $this->hasMany(UsageTrxH::class);
    }
}
