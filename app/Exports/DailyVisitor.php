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

class DailyVisitor implements FromCollection
{
    public function collection()
    {
        // return Invoice::all();
        // return 
        // $visitorByGeo = Analytics::fetchVisitor(Period::years(1));
        // return $visitorByGeo;

        // $visitorByGagdet = Analytics::fetchVisitorByGagdet(Period::years(1));
        // return $visitorByGagdet;

        $dailyVisit = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        return $dailyVisit;
    }
}