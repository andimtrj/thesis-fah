<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class DailyIngredient extends Model
{
    use HasFactory;
    protected $table = 'daily_ingredients';

    public function Ingredients() : BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function GetPagingSummary(Request $request){

    }

}
