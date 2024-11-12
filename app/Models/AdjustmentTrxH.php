<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdjustmentTrxH extends Model
{
    use HasFactory;
    protected $table = 'adjustment_trx_h';

    protected $fillable = [
        'adjustment_trx_no',
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

    public function AdjustmentTrxD(){
        return $this->hasMany(AdjustmentTrxD::class, 'adjustment_trx_h_id');
    }

    public static function GetPagingAdjustmentTrx(Request $request){
        $authTenantId = Auth::user()->tenant_id;
        $authBranchId = Auth::user()->branch_id;

        if ($authTenantId) {
            $query = AdjustmentTrxH::join('branches as b', 'adjustment_trx_h.branch_id', '=', 'b.id')
                        ->join('users as u', 'adjustment_trx_h.user_create_id', '=', 'u.id')
                        ->join('roles as r', 'u.role_id', '=', 'r.id')
                        ->join('adjustment_trx_d as atd', 'atd.adjustment_trx_h_id', '=', 'adjustment_trx_h.id')
                        ->where('adjustment_trx_h.tenant_id', '=', $authTenantId);

            if($request->has('branchCode'))
            {
                $query->where('b.branch_code', '=', $request->input('branchCode'));
            }
            else if($authBranchId)
            {
                $query->where('adjustment_trx_h.branch_id', '=', $authBranchId);
            }
            else
            {
                throw new Exception("INVALID BRANCH");
            }

            // Apply filters if branchCode or branchName is provided
            if ($request->input('trxNo')) {
                $paramTrxNo = $request->input('trxNo', null);
                $query->where('adjustment_trx_h.adjustment_trx_no', 'like', '%' . $paramTrxNo . '%');
            }

            if ($request->input('startDate')) {
                $paramStartDate = $request->input('startDate', null);
                $startDate = Carbon::createFromFormat('m/d/Y', $paramStartDate)->format('Y-m-d');
                $query->where('adjustment_trx_h.trx_date', '>=', $paramStartDate);
            }

            if ($request->input('endDate')) {
                $paramEndDate = $request->input('endDate', null);
                $endDate = Carbon::createFromFormat('m/d/Y', $paramEndDate)->format('Y-m-d');
                $query->where('adjustment_trx_h.trx_date', '<=', $paramEndDate);
            }

            $usageTrx = $query->select(
                                        'adjustment_trx_h.adjustment_trx_no',
                                        'b.branch_name',
                                        DB::raw('COUNT(DISTINCT atd.ingredient_id) as total_ingredient'),
                                        DB::raw("CONCAT(u.first_name, ' ', u.last_name, ' - ', r.role_name) as submitted_by"),
                                        DB::raw("DATE_FORMAT(adjustment_trx_h.trx_date, '%Y-%m-%d') as trx_date")

                                    )
                                ->groupBy('adjustment_trx_h.adjustment_trx_no', 'b.branch_name', 'u.first_name', 'u.last_name', 'r.role_name', 'adjustment_trx_h.trx_date')
                                ->orderBy('adjustment_trx_h.created_at', 'desc');
        } else {
            throw new \Exception("Tenant Code Is Null");
        }
        return $usageTrx->paginate(10);

    }

}
