<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Tenant;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UsageTrxH;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsageTrxHController extends Controller
{
    private $usageTrxDController;
    public function __construct(UsageTrxDController $usageTrxDController)
    {
        $this->usageTrxDController = $usageTrxDController;
    }

    public function InsertUsageTrxH(Request $request){
        $validator = $this->validateUsageTrxHRequest($request);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            DB::transaction(function () use ($request, &$response) {
                $usageTrxH = $this->createUsageTrxH($request);
                $usageTrxH->save();

                $this->usageTrxDController->InsertUsageTrxD($request, $usageTrxH);
                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

            });

            return redirect()->intended('/usage')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/add-usage')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }

    }

    private function validateUsageTrxHRequest(Request $request){
        return Validator::make($request->all(), [
            'branchCode' => 'required|string|max:8|exists:branches,branch_code',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'trxDate' => 'required|date',
            'products' => 'required|array',
            'products.*.productCode' => 'required|string|exists:products,product_code',
            'products.*.productAmt' => 'required|numeric|min:0',
            'products.*.notes' => 'string|nullable'
        ]);
    }

    private function createUsageTrxH(Request $request){
        $usageTrxNo = $this->generateUsageTrxNo();
        $UsageTransactionTypeId = TransactionType::where('trx_code', '=', 'USG')->value('id');
        if ($UsageTransactionTypeId === null) {
            // Handle the case where no matching record is found
            // For example, you can throw an exception or log an error
            throw new \Exception('Transaction type with code USG not found');
        }
        $branchId = Branch::where('branch_code', '=', $request->input('branchCode'))->value('id');
        if ($branchId === null) {
            // Handle the case where no matching record is found
            // For example, you can throw an exception or log an error
            throw new \Exception('Branch with code ' . $request->input('branchCode') . ' not found');
        }

        $tenantId = Tenant::where('tenant_code', '=', $request->input('tenantCode'))->value('id');
        if ($tenantId === null) {
            // Handle the case where no matching record is found
            // For example, you can throw an exception or log an error
            throw new \Exception('Tenant with code ' . $request->input('tenantCode') . ' not found');
        }

        if($request->input('trxDate') == null){
            throw new \Exception('Transaction Date is Empty!');
        }

        $userCreateId = Auth::id();

        $trxDate = Carbon::createFromFormat('d/m/Y', $request->input('trxDate'))->startOfDay();
        $usageTrxH = new UsageTrxH();
        $usageTrxH->usage_trx_no = $usageTrxNo;
        $usageTrxH->transaction_type_id = $UsageTransactionTypeId;
        $usageTrxH->branch_id = $branchId;
        $usageTrxH->tenant_id = $tenantId;
        $usageTrxH->user_create_id = $userCreateId;
        $usageTrxH->trx_date = $trxDate;


        return $usageTrxH;
    }

    private function generateUsageTrxNo(){
        $lastUsageTrxNo = DB::table('usage_trx_h')
            ->orderBy('usage_trx_no', 'desc')
            ->first()
            ->usage_trx_no ?? null;

        if ($lastUsageTrxNo == null) {
            $newUsageTrxNo = 'USG000000001';
        } else {
            $lastUsageTrxNoNum = (int) substr($lastUsageTrxNo, 3);

            $newNumber = ++$lastUsageTrxNoNum;

            $newUsageTrxNo = 'USG' . str_pad($newNumber, 9, '0', STR_PAD_LEFT);
        }

        return $newUsageTrxNo;
    }
}
