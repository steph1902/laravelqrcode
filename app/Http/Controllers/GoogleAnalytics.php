<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Arr;
use Khill\Lavacharts\Lavacharts;

class GoogleAnalytics extends Controller
{
	public function googleMultiChart()
	{
		return view('multiplechart');
	}

    //Total Visitors by Geographic
    public function googleChart()
    {
		
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



		// dd($getVisitorByGagdet);

    	return view('googlechart',compact('countries','visitors','getVisitorByGagdet','gagdet'));
    }

	public function googleMagic()
	{

		$total_visitors_by_geo = Analytics::fetchTotalVisitorByGeographic(Period::years(1));
		dd($total_visitors_by_geo);

		// return view('statistic',compact('total_visitors_by_geo'));

	}	
}
