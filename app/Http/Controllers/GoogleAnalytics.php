<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Arr;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnalyticsExport;
use App\Exports\VisitorByGagdet;
use App\Exports\DailyVisitor;
use App\URL;

class GoogleAnalytics extends Controller
{
	// public function editUrl(Requ)
 //    {
 //        // $url = url::where('id', '=' , $id)->first();
 //        $url = url::find($id);
 //        // dd($url);
 //        // 
 //        $url->url = $request->get('url');
 //        // dd($request->get('url'));
 //        $url->save();

 //        return redirect('dashboard')->with('success','Edited URL successfully');

 //    }

	public function redirectingPage($id)
	{
		// $
		$url = url::find($id);
		$longurl = $url->url;
		// dd($longurl);

		return view('redirectingpage',compact('longurl'));
	}

	public function export() 
	{
		// $visitorByGeo = Analytics::fetchVisitor(Period::years(1));
		// dd($visitorByGeo);
		return Excel::download(new AnalyticsExport, 'Visitors by Geographic.csv');
	}

	public function exportVisitorByGagdet() 
	{
		// $visitorByGeo = Analytics::fetchVisitor(Period::years(1));
		// dd($visitorByGeo);
		return Excel::download(new VisitorByGagdet, 'Visitors by Gagdet.csv');
	}

	public function exportDailyVisitor() 
	{
		// $visitorByGeo = Analytics::fetchVisitor(Period::years(1));
		// dd($visitorByGeo);
		return Excel::download(new DailyVisitor, 'Daily Visitors.csv');
	}

	public function googleMultiChart()
	{
		return view('multiplechart');
	}

	public function refreshChart(Request $request)
	{
		// dd('here');

		$request->validate(
			[
				'start_date'=>'required',
				'end_date'=> 'required|after:start_date',

			]);

		$start_date = $request->get('start_date');
		$end_date = $request->get('end_date');

		$start_date = Carbon::createFromFormat('Y-m-d',$start_date);
		$end_date = Carbon::createFromFormat('Y-m-d',$end_date);
		
		$difference = $end_date->diffInDays($start_date);

		// dd($difference);
		$visitorByGeo = Analytics::fetchVisitor(Period::days($difference));
		// dd($visitorByGeo);
		// return view('googlechart')->with('success','Chart updated');
	}

    //Total Visitors by Geographic
	public function googleChart(Request $request)
	{

		if($request->has('start_date') && $request->has('end_date'))
		{
			// dd('here');
			$request->validate(
				[
					'start_date'=>'required',
					'end_date'=> 'required|after:start_date',

				]);

			$start_date = $request->get('start_date');
			$end_date = $request->get('end_date');

			$start_date = Carbon::createFromFormat('Y-m-d',$start_date);
			$end_date = Carbon::createFromFormat('Y-m-d',$end_date);
			
			$difference = $end_date->diffInDays($start_date);	

			$visitorByGeo = Analytics::fetchVisitor(Period::days($difference));
			$visitorByGagdet = Analytics::fetchVisitorByGagdet(Period::days($difference));
			$dailyVisit = Analytics::fetchTotalVisitorsAndPageViews(Period::days($difference));
		}
		else
		{
			$visitorByGeo = Analytics::fetchVisitor(Period::years(1));
			$visitorByGagdet = Analytics::fetchVisitorByGagdet(Period::years(1));
			$dailyVisit = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

		}
		

		// dd($difference);
		// $visitorByGeo = Analytics::fetchVisitor(Period::days($difference));
    	/*
			Chart 1

    	*/

			
			// dd($visitorByGeo);
		$i = 0; //visitors
		$a = 0; //countries
		// echo $i;

		$visitors = array();
		foreach ($visitorByGeo as $totalvisitors) 
		{
			
			$visitors[] = $visitorByGeo[$i]['users'];
			$i = $i + 1;
		}

		$countries = array();
		foreach ($visitorByGeo as $country) 
		{
			# code...
			$countries[] = $visitorByGeo[$a]['country'];
			$a = $a + 1;
		}


		$c = 0;

		$testdata = array();
		foreach ($visitorByGeo as $data) 
		{
			# code...
			$testdata[] = $visitorByGeo[$c];
			$c = $c + 1;
		}

		/*
			Chart 2

    	*/

			
		// dd($visitorByGagdet);

		//Get Total Visitor by each gagdet
			$g = 0;
			$getVisitorByGagdet = array();
			foreach ($visitorByGagdet as $totalVisitorsByGagdet) 
			{
				$getVisitorByGagdet[] = $visitorByGagdet[$g]['users'];
				$g = $g + 1;
			# code...
			}

		//Get Gagdet/Browser
			$gdt=0;
			$gagdet = array();
			foreach ($visitorByGagdet as $totalVisitorsByGagdet) 
			{	
				$gagdet[] = $visitorByGagdet[$gdt]['browser'];
				$gdt = $gdt + 1;
			# code...
			}
		// dd($gagdet);


		/*
			Chart 3

    	*/

			

			$dvt = 0;
			$dailyVisitDate = array();
			//get visitor date
			foreach($dailyVisit as $dailyVisitByDate)
			{
					// $dailyVisitDate[] = Carbon::createFromFormat('Ymd', $dailyVisit[$dvt]['date']);
				$dailyVisitDate[] = $dailyVisit[$dvt]['date'];
				$dvt = $dvt + 1;
			}
			// dd($dailyVisitDate);

			$dailyVisitors = array();
			$dvts = 0;
			//get daily visitor
			foreach ($dailyVisit as $dailyVisitorsByDate) 
			{		
				$dailyVisitors[] = $dailyVisit[$dvts]['visitors'];
				$dvts = $dvts + 1;
			}

			// dd($dailyVisit);

			//get daily page view
			$dailyPageView = array();
			$dpv = 0;

			foreach($dailyVisit as $dailyPageViews)
			{
				$dailyPageView[] = $dailyVisit[$dpv]['pageViews'];
				$dpv = $dpv + 1;
			}

			
			// dd($dailyPageView);

		// dd($getVisitorByGagdet);

			return view('googlechart'
				,compact('countries',
					'visitors',
					'getVisitorByGagdet',
					'gagdet',
					'dailyVisitDate',
					'dailyVisitors',
					'dailyPageView'));
		}

		
	}
