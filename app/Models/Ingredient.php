<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ingredient extends Model
{
    use HasFactory;

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

    public static function GetPagingIngredient(Request $request)
    {
        $authTenantId = Auth::user()->tenant_id;
        $authBranchId = Auth::user()->branch_id;

        if ($authTenantId) {
            $query = Ingredient::from('ingredients as i')
                                ->join('tenants as t', 'i.tenant_id', '=', 't.id')
                                ->join('branches as b', 'i.branch_id', '=', 'b.id')
                                ->join('metrics as m', 'i.metric_id', '=', 'm.id')
                                ->where('i.tenant_id', '=', $authTenantId);
            if($authBranchId)
            {
                $query->where('i.branch_id', '=', $authBranchId);
            }
            else if($request->has('branch_code'))
            {
                $query->where('b.branch_code', '=', $request->input('branch_code'));
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

            $ingredients = $query->select('i.ingredient_code', 'i.ingredient_name', 'i.ingredient_amt', 'm.metric_unit')->paginate(10); // Paginate the results
        } else {
            throw new \Exception("Tenant Code Is Null");
        }

        return $ingredients;

    }

}
