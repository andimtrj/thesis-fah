<?php

namespace App\Models;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ingredient_code',
        'ingredient_name',
        'metric_id',
        'tenant_id' ,
        'branch_id' ,
        'ingredient_amt',
        'created_by',
        'updated_by'
    ];


    public function metric(): BelongsTo
    {
        return $this->belongsTo(Metric::class);
    }


    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function productIngredientD(){
        return $this->hasMany(productIngredientD::class);
    }

    public static function GetPagingIngredient(Request $request)
    {
        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId) {
            $query = Ingredient::from('ingredients as i')
                                ->join('tenants as t', 'i.tenant_id', '=', 't.id')
                                ->join('branches as b', 'i.branch_id', '=', 'b.id')
                                ->join('metrics as m', 'i.metric_id', '=', 'm.id')
                                ->select('i.id',
                                        'i.ingredient_code',
                                        'i.ingredient_name',
                                        DB::raw('FORMAT(i.ingredient_amt / POWER(10, m.metric_seq_no - 1), 2) as ingredient_amt'),
                                        'm.metric_unit as metric_unit')
                                ->orderBy('i.created_at', 'desc')
                                ->where('i.tenant_id', '=', $authTenantId);
            // dd($query, $request);
            // dd($authBranchId, $request->input('branch_code'), $request);
            if($request->has('branchCode'))
            {
                $query->where('b.branch_code', '=', $request->input('branchCode'));
                $query->where('b.branch_code', '=', $request->input('branchCode'));
            }
            else
            {
                throw new Exception("INVALID BRANCH");
            }

            // Apply filters if branchCode or branchName is provided
            if ($request->input('ingredientCode')) {
                $paramIngredientCode = $request->input('ingredientCode', null);
                $query->where('i.ingredient_code', 'like', '%' . $paramIngredientCode . '%');
            }

            if ($request->input('ingredientName')) {
                $paramIngredientName = $request->input('ingredientName', null);
                $query->where('i.ingredent_name', 'like', '%' . $paramIngredientName . '%');
            }

            $ingredients = $query->paginate(10); // Paginate the results
        } else {
            abort(500, "Invalid Tenant");
        }

        // dd($ingredients);
        return $ingredients;

    }

}
