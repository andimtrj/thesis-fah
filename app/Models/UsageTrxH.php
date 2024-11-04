<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageTrxH extends Model
{
    use HasFactory;

    protected $fillable = [
        'usage_trx_no',
        'transaction_type_id',
        'branch_id',
        'tenant_id',
        'user_create_id',
        'trx_date'
    ];

    public function TransactionTypes(){
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

    public function UsageTrxD(){
        return $this->hasMany(UsageTrxD::class, 'usage_trx_h_id');
    }



}
