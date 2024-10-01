<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Tenant;
use App\DTO\BaseResponseObj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\TenantController;
use App\View\Components\branch as ComponentsBranch;

class BranchController extends Controller
{
    protected $userController;
    protected $tenantController;

    public function __construct(TenantController $tenantController)
    {
        $this->tenantController = $tenantController;
    }

    // #region Insert Branch
    public function CreateBranch(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'branchName' => 'required|string|max:255',
            'tenantCode' => 'required|string|max:8|exists:tenants,tenant_code',
            'branchAddress' => 'required|string|max:255',
            'branchCity' => 'required|string|max:255',
            'branchProvince' => 'required|string|max:255',
            'branchZipCode' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{

            DB::transaction(function() use($request, &$response){
                $branchCode = $this->GenerateBranchCode();
                $tenantId = Tenant::GetTenantIdByTenantCode($request->input('tenantCode'));

                Branch::create([
                    'branch_code' => $branchCode,
                    'branch_name' => $request->input('branchName'),
                    'tenant_id' => $tenantId,
                    'address' => $request->input('branchAddress'),
                    'city' => $request->input('branchCity'),
                    'province' => $request->input('branchProvince'),
                    'zip_code' => $request->input('branchZipCode'),
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);


                $response = new BaseResponseObj();
                $response->statusCode = '200';
                $response->message = 'Registration Success!';

                return $response;
            });

            return redirect()->intended('/branch')->with('status', $response->statusCode);

        }catch(\Exception $e){
            $response = new BaseResponseObj();
            $response->statusCode = '500';
            $response->message = 'An Error Occurred During Registration. ' . $e->getMessage();

            return redirect()->intended('/branch')->with('status', $response->message);

        }
    }
    // #endregion

    // #region Generate Branch Code
    private static function GenerateBranchCode(){
        $lastBranchCode = DB::table('branches')
        ->orderBy('branch_code', 'desc')
        ->first()
        ->branch_code ?? null;


        if($lastBranchCode == null){
            $newBranchCode = 'B0000001';
        }
        else{
            $lastBranchCodeNum = (int) substr($lastBranchCode, 1);

            $newNumber = ++$lastBranchCodeNum;

            $newBranchCode = 'B' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }

        return $newBranchCode;

    }
    // #endregion

    // #region Get

    // #endregion

    public function showBranchPaging(Request $request)
    {
        $formSubmitted = $request->has('branchCode') || $request->has('branchName') || $request->has('page');
        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            $branches = Branch::GetPagingBranch($request)->withQueryString(); // Call the Model method here
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return view('branch', compact('branches', 'formSubmitted')); // Pass variables to view
    }

    public function DetailBranchPage($id){

        // Find the branch by id
        $branch = Branch::findOrFail($id);

        // Pass the branch to the view
        return view('components.branch.edit-branch', compact('branch'));
    }

    public function UpdateBranch(Request $request, $id){
        $validatedData = $request->validate([
            'branch_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
        ]);

        // Find the branch by id
        $branch = Branch::findOrFail($id);

        // Update the branch with validated data
        $branch->update($validatedData);

        return redirect(route('branch'))->with('success', 'Branch updated successfully.');

    }
}
