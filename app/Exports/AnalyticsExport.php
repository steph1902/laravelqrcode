<?php

namespace App\Exports;

// use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Arr;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;

class AnalyticsExport implements FromCollection
{
    public function collection()
    {
        // return Invoice::all();
        // return 
        $visitorByGeo = Analytics::fetchVisitor(Period::years(1));
        return $visitorByGeo;
    }
}