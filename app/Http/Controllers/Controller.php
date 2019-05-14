<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\URL;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getChangePassPage()
    {
    	$user = Auth::user();
    	return view('auth.changepassword');
    	// dd($user);

    }

    

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) 
        {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('old_password'), $request->get('new-password')) == 0)
        {
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
        		'old_password' => 'required',
            	'new_password' => 'required',
            	'confirm_password' => 'required|same:new_password'

            // 'old_password' => 'required',
            // 'new_password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function dashboard()
    {
        $id = Auth::id();
        $urls = url::where('user_id' , '=', $id)->simplePaginate(5);
        return view('dashboard',compact('urls'));


    }



    public function getAddUrlPage()
    {
        return view('addurl');
    }

    public function addUrl(Request $request)
    {
        $random = Str::random(5);
        $domain = 'http://domain.com/'.$random;
        $id = Auth::id();

        $url = new URL();
        $url->short_url = $domain;
        $url->user_id = $id;
        $url->save();

        return redirect('dashboard');



    }

    //go to update page
    public function edit($id)
    {
        $car = Car::find($id);
        return view('caredit',compact('car','id'));
    }

    public function update(Request $request,$id)
    {
        $car = Car::find($id);
        $car->carcompany = $request->get('carcompany');
        $car->model = $request->get('model');
        $car->price = $request->get('price');

        $validatedData = $request->validate
        (
            [
                'carcompany'=>'required',
                'model'=>'required',
                'price'=>'required','digits_between:min=1,max=1000000'
            ]
        );

        $car->save();

        return redirect('car')->with('success','Car has been successfully updated');
    }
    public function getEditUrlPage($id)
    {
        $url = url::find($id);
        return view('editurlpage',compact('url','id'));
    }
    public function editUrl(Request $request,$id)
    {
        // $url = url::where('id', '=' , $id)->first();
        $url = url::find($id);
        // dd($url);
        $url->url = $request->get('url');
        $url->save();

        return redirect('dashboard')->with('success','Edited URL successfully');

    }

    public function downloadQrCode($id)
    {

        $url = url::find($id);
        $shortUrl = $url->short_url;

        $newName = 'qr-code-'.time().'.svg';
        $filePath = base_path().'\storage\app\public\qrcodes\\'.$newName;

        $qr =  QrCode::size(100)->generate($shortUrl,$filePath);
            
        $headers = ['Content-Type: image/svg+xml'];
    
        return response()->download($filePath, $newName, $headers);


    }

    public function getStatisticPage()
    {
        return view('statistic');
    }




}
