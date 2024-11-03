<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    public function Ingredients(){
        return $this->hasMany(Ingredient::class);
    }

    public function MetricGroup(){
        return $this->belongsTo(MetricGroup::class, 'metric_group_id');
    }

    public static function GetMetricIdByMetricCode(string $metricCode){

        $metric = Metric::where('metric_code', $metricCode)->firstOrFail();
        return $metric->id;
    }

}
