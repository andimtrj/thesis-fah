<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SummaryExport implements FromView
{
    protected $summary;

    public function __construct($summary)
    {
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('exports.summary', [
            'summary' => $this->summary,
        ]);
    }
}
