<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Arr;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;

class GoogleAnalytics extends Controller
{
	public function googleMultiChart()
	{
		return view('multiplechart');
	}

    //Total Visitors by Geographic
	public function googleChart()
	{

    	/*
			Chart 1

    	*/

			$visitorByGeo = Analytics::fetchVisitor(Period::years(1));
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

			$visitorByGagdet = Analytics::fetchVisitorByGagdet(Period::years(1));
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

			$dailyVisit = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

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

			return view('googlechart',compact('countries','visitors','getVisitorByGagdet','gagdet','dailyVisitDate','dailyVisitors','dailyPageView'));
		}

		public function googleMagic()
		{

			$total_visitors_by_geo = Analytics::fetchTotalVisitorByGeographic(Period::years(1));
			dd($total_visitors_by_geo);

		// return view('statistic',compact('total_visitors_by_geo'));

		}	
	}
