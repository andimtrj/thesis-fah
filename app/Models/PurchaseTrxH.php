<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTrxH extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_trx_no',
        'transaction_type_id',
        'branch_id',
        'tenant_id',
        'user_create_id',
        'trx_date'
    ];

    public function TransactionType(){
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function Branches(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function Tenants(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function UserCreate(){
        return $this->belongsTo(User::class, 'user_create_id');
    }

    public function PurchaseTrxD(){
        return $this->hasMany(PurchaseTrxD::class, 'purchase_trx_h_id');
    }
}
