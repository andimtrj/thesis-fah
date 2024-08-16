<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;


class TenantController extends Controller
{
    private function GenerateTenantCode(){
        $lastTenantCode = DB::table('tenants')
                            ->orderBy('tenant_code', 'desc')
                            ->first()
                            ->tenant_code ?? null;
        if($lastTenantCode == null){
            $newTenantCode = 'T0000001';
        }
        else{
            $lastTenantCodeNum = (int) substr($lastTenantCode, 1);

            $newNumber = ++$lastTenantCodeNum;

            $newTenantCode = 'T' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newTenantCode;
    }

    public function CreateTenant(Request $request){
        $tenantCode = $this->GenerateTenantCode();

        $tenant = Tenant::create([
            'tenant_code' => $tenantCode,
            'tenant_name' => $request->tenantName,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zipCode
        ]);

        return $tenant;
    }
}
