<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseTrxH extends Model
{
    use HasFactory;
    protected $table = 'purchase_trx_h';

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

    public static function GetPagingPurchaseTrx(Request $request){
        $authTenantId = Auth::user()->tenant_id;
        $authBranchId = Auth::user()->branch_id;

        if ($authTenantId) {
            $query = PurchaseTrxH::join('branches as b', 'purchase_trx_h.branch_id', '=', 'b.id')
                                ->join('users as u', 'purchase_trx_h.user_create_id', '=', 'u.id')
                                ->join('roles as r', 'u.role_id', '=', 'r.id')
                                ->join('purchase_trx_d as ptd', 'ptd.purchase_trx_h_id', '=', 'purchase_trx_h.id')
                                ->where('purchase_trx_h.tenant_id', '=', $authTenantId);

            if($request->has('branchCode'))
            {
                $query->where('b.branch_code', '=', $request->input('branchCode'));
            }
            else if($authBranchId)
            {
                $query->where('purchase_trx_h.branch_id', '=', $authBranchId);
            }
            else
            {
                throw new Exception("INVALID BRANCH");
            }

            // Apply filters if branchCode or branchName is provided
            if ($request->input('trxNo')) {
                $paramTrxNo = $request->input('trxNo', null);
                $query->where('purchase_trx_h.purchase_trx_no', 'like', '%' . $paramTrxNo . '%');
            }

            if ($request->input('startDate')) {
                $paramStartDate = $request->input('startDate', null);
                $startDate = Carbon::createFromFormat('m/d/Y', $paramStartDate)->format('Y-m-d');
                $query->where('purchase_trx_h.trx_date', '>=', $startDate);
            }

            if ($request->input('endDate')) {
                $paramEndDate = $request->input('endDate', null);
                $endDate = Carbon::createFromFormat('m/d/Y', $paramEndDate)->format('Y-m-d');
                $query->where('purchase_trx_h.trx_date', '<=', $endDate);
            }

            $purchaseTrxH = $query->select(
                                        'purchase_trx_h.purchase_trx_no',
                                        'b.branch_name',
                                        DB::raw('COUNT(DISTINCT ptd.ingredient_id) as total_ingredient'),
                                        DB::raw("CONCAT(u.first_name, ' ', u.last_name, ' - ', r.role_name) as submitted_by"),
                                        DB::raw("DATE_FORMAT(purchase_trx_h.trx_date, '%Y-%m-%d') as trx_date")
                                    )
                                ->groupBy('purchase_trx_h.purchase_trx_no', 'b.branch_name', 'u.first_name', 'u.last_name', 'r.role_name', 'purchase_trx_h.trx_date')
                                ->orderBy('purchase_trx_h.created_at', 'desc');
        } else {
            throw new \Exception("Tenant Code Is Null");
        }
        return $purchaseTrxH->paginate(10);

    }
}
