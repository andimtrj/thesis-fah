<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Exports\SummaryExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SummaryPageController extends Controller
{
    public function ShowSummaryPage(Request $request){
        $formSubmitted = $request->has('branchCode') ||
                        $request->has('startDate') ||
                        $request->has('endDate');

        $authTenantId = Auth::user()->tenant_id;
        $branches = Branch::where('tenant_id', '=', $authTenantId)->get();
        if ($authTenantId) {
            // Ambil tenant berdasarkan tenant_id user untuk display tenant_name
            $tenant = Tenant::find($authTenantId);
            if($formSubmitted){

                if(!$request->input('startDate'))
                {
                    $startDate = Carbon::today()->startOfDay();
                }
                else
                {
                    $startDate = Carbon::parse($request->input('startDate'))->startOfDay();
                }

                if(!$request->input('endDate'))
                {
                    $endDate = Carbon::today()->endOfDay();
                }
                else
                {
                    $endDate = Carbon::parse($request->input('endDate'))->endOfDay();
                }


                if(!$request->input('branchCode'))
                {
                    abort(404, "Branch Empty!");
                }
                $branch = Branch::where('branch_code', $request->input('branchCode'))->first();
                // dd($startDate, $endDate, $branch->id);
                $summary = DB::select('CALL spget_summarydata(?, ?, ?)', [
                    $startDate,
                    $endDate,
                    $branch->id
                ]);

                return view('summary', compact('tenant', 'branches', 'formSubmitted', 'summary', 'branch')); // Pass tenant variable to view

            }
        } else {
            abort(500, "Invalid Tenant");
        }

        return view('summary', compact('tenant', 'branches',  'formSubmitted')); // Pass tenant variable to view

    }

    public function ExportToExcel(Request $request)
    {
        $summary = json_decode($request->summary);
        $tenant = $request->tenant;
        $branch = $request->branch;
        $date = $request->date;

        $fileName = "SUMMARY-" . preg_replace('/[^A-Za-z0-9_-]/', '', $date) . "-{$branch}-{$tenant}.xlsx";

        // dd($summary);
        return Excel::download(new SummaryExport($summary), $fileName);
    }

}
