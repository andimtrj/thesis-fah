<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function GetTenantIdByTenantCode(Request $request){
        $validator = Validator::make($request->all(), [
            'tenantCode' => 'required|string|max:255|exists:tenants,tenant_code'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $tenant = Tenant::where('tenant_code', $request->tenantCode)->firstOrFail();
        return $tenant->id;
    }

}
