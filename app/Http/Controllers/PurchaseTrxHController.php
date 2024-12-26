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
use App\Models\PurchaseTrxH;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseTrxHController extends Controller
{
    protected $purchaseTrxDController;
    protected $validatorController;

    public function __construct(PurchaseTrxDController $purchaseTrxDController, ValidatorController $validatorController)
    {
        $this->purchaseTrxDController = $purchaseTrxDController;
        $this->validatorController = $validatorController;
    }

    public function InsertPurchaseTrxH(Request $request){
        $validator = $this->validatorController->IngredientTransactionValidator($request, 'PUR');

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            DB::transaction(function () use ($request, &$response) {
                $usageTrxH = $this->createPurchaseTrxH($request);
                $usageTrxH->save();

                $this->purchaseTrxDController->InsertPurchaseTrxD($request, $usageTrxH);
                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

            });

            return redirect()->intended('/purchase')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/add-purchase')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }

    }

    private function createPurchaseTrxH(Request $request){
        $purchaseTrxNo = $this->generatePurchaseTrxNo();

        $purchaseTransactionTypeId = TransactionType::where('trx_code', '=', 'PUR')->value('id');
        if ($purchaseTransactionTypeId === null) {
            // Handle the case where no matching record is found
            // For example, you can throw an exception or log an error
            throw new \Exception('Transaction type with code PUR not found');
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

        $userCreateId = Auth::id();
        $trxDate = Carbon::createFromFormat('d/m/Y', $request->input('trxDate'))->startOfDay();

        $purchaseTrxH = new PurchaseTrxH();
        $purchaseTrxH->purchase_trx_no = $purchaseTrxNo;
        $purchaseTrxH->transaction_type_id = $purchaseTransactionTypeId;
        $purchaseTrxH->branch_id = $branchId;
        $purchaseTrxH->tenant_id = $tenantId;
        $purchaseTrxH->user_create_id = $userCreateId;
        $purchaseTrxH->trx_date = $trxDate;

        return $purchaseTrxH;
    }

    private function generatePurchaseTrxNo(){
        $lastPurchaseTrx = DB::table('purchase_trx_h')
            ->orderBy('purchase_trx_no', 'desc')
            ->first()
            ->purchase_trx_no ?? null;

        if ($lastPurchaseTrx == null) {
            $newPurchaseTrxNo = 'PUR000000001';
        } else {
            $lastPurchaseTrxNum = (int) substr($lastPurchaseTrx, 3);

            $newNumber = ++$lastPurchaseTrxNum;

            $newPurchaseTrxNo = 'PUR' . str_pad($newNumber, 9, '0', STR_PAD_LEFT);
        }

        return $newPurchaseTrxNo;
    }


}
