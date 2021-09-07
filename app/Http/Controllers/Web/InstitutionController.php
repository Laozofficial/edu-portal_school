<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InstitutionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }


    public function save_institution(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|min:11',
            'country_id' => 'required',
            'currency_id' => 'required',
            'language_id' => 'required',
            'state_id' => 'required',
            'logo' => 'required'
        ]);

        $institution = new Institution;
        $institution->name = $request->get('name');
        $institution->email = $request->get('email');
        $institution->phone = $request->get('phone');
        $institution->country_id = $request->get('country_id');
        $institution->language_id = $request->get('language_id');
        $institution->state_id = $request->get('state_id');
        $institution->currency_id = $request->get('currency_id');
        $institution->website = $request->get('website');
        $institution->prefix_code = $request->get('prefix_code');
        $institution->slug = Str::slug($request->get('name').'-');
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extension = $logo->getClientOriginalExtension(); // you can also use file name
            $image =   '-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $logo->move($path, $image);

            $institution->logo = $image;
        }

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $extension = $signature->getClientOriginalExtension(); // you can also use file name
            $image = '-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $signature->move($path, $image);

            $institution->logo = $image;
        }

        $institution->user_id = Auth::user()->id;
        $institution->save();

        $response = [
            'success' => 'Institution has been added Successfully'
        ] ;

        return response($response, 200);
    }
}
