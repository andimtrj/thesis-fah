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
use App\Models\AdjustmentTrxH;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdjustmentTrxHController extends Controller
{
    protected $adjustmentTrxDController;
    protected $validatorController;


    public function __construct(AdjustmentTrxDController $adjustmentTrxDController, ValidatorController $validatorController)
    {
        $this->adjustmentTrxDController = $adjustmentTrxDController;
        $this->validatorController = $validatorController;
    }

    public function InsertAdjustmentTrxH(Request $request){
        $validator = $this->validatorController->IngredientTransactionValidator($request, 'ADJ');

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            DB::transaction(function () use ($request, &$response) {
                $adjustmentTrxH = $this->createAdjustmentTrxH($request);
                $adjustmentTrxH->save();

                $this->adjustmentTrxDController->InsertAdjustmentTrxD($request, $adjustmentTrxH);
                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;

            });

            return redirect()->intended('/adjustment')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);
        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration : ' . $e->getMessage();

            return redirect()->intended('/add-adjustment')->with([
                'status' => $response->statusCode,
                'message' => $response->message,
            ]);

        }

    }

    private function createAdjustmentTrxH(Request $request){
        $adjustmentTrxNo = $this->generateAdjustmentTrxNo();

        $adjustmentTransactionTypeId = TransactionType::where('trx_code', '=', 'ADJ')->value('id');
        if ($adjustmentTransactionTypeId === null) {
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

        $adjustmentTrxH = new AdjustmentTrxH();
        $adjustmentTrxH->adjustment_trx_no = $adjustmentTrxNo;
        $adjustmentTrxH->transaction_type_id = $adjustmentTransactionTypeId;
        $adjustmentTrxH->branch_id = $branchId;
        $adjustmentTrxH->tenant_id = $tenantId;
        $adjustmentTrxH->user_create_id = $userCreateId;
        $adjustmentTrxH->trx_date = $trxDate;

        return $adjustmentTrxH;
    }

    private function generateAdjustmentTrxNo(){
        $lastAdjustmentTrx = DB::table('adjustment_trx_h')
            ->orderBy('adjustment_trx_no', 'desc')
            ->first()
            ->adjustment_trx_no ?? null;

        if ($lastAdjustmentTrx == null) {
            $newAdjustmentTrxNo = 'ADJ000000001';
        } else {
            $lastAdjustmentTrxNum = (int) substr($lastAdjustmentTrx, 3);

            $newNumber = ++$lastAdjustmentTrxNum;

            $newAdjustmentTrxNo = 'ADJ' . str_pad($newNumber, 9, '0', STR_PAD_LEFT);
        }

        return $newAdjustmentTrxNo;
    }

}
