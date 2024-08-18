<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_code',
        'tenant_name',
        'address',
        'city',
        'province',
        'zip_code'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
