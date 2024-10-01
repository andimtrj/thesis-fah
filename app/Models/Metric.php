<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    public static function GetMetricIdByMetricCode(string $metricCode){

        $metric = Metric::where('metric_code', $metricCode)->firstOrFail();
        return $metric->id;
    }

}
