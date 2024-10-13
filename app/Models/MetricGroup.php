<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricGroup extends Model
{
    use HasFactory;

    public function Metrics(){
        return $this->hasMany(Metric::class);
    }
}
