<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function GetBranchByBranchCode(Request $request){
        $validator = Validator::make($request->all(), [
            'branchCode' => 'required|string|max:255|exists:branches,branch_code'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        return Branch::where('branch_code', $request->branchCode)->firstOrFail();

    }

}
