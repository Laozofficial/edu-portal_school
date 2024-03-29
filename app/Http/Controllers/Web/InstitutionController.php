<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Teacher;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|min:11',
            'country_id' => 'required',
            'currency_id' => 'required',
            'language_id' => 'required',
            'state_id' => 'required',
            'logo' => 'required',
            'signature' => 'required',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $institution = new Institution;
        $institution->name = $request->get('name');
        $institution->email = $request->get('email');
        $institution->phone = $request->get('phone');
        $institution->address = $request->get('address');
        $institution->country_id = $request->get('country_id');
        $institution->language_id = $request->get('language_id');
        $institution->state_id = $request->get('state_id');
        $institution->currency_id = $request->get('currency_id');
        $institution->website = $request->get('website');
        $institution->prefix_code = $request->get('prefix');
        $institution->slug = Str::slug($request->get('name').'-');
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extension = $logo->getClientOriginalExtension(); // you can also use file name
            $logo_image =   Auth::user()->id.'-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $logo->move($path, $logo_image);

            $institution->logo = $logo_image;
        }

        // if ($request->hasFile('signature')) {
        //     $signature = $request->file('signature');
        //     $extension = $signature->getClientOriginalExtension(); // you can also use file name
        //     $image = Auth::user()->id.'-1-' . time() . '.' . $extension;
        //     $path = Env('PUBLIC_IMAGE_PATH');
        //     $upload = $signature->move($path, $image);

        //     $institution->signature = $image;
        // }

        $institution->user_id = Auth::user()->id;
        $institution->save();


        if(env('APP_THEME') == 'easy_school') {
            // $subscription = new Subscription;
            // $subscription->subscription_type_id = 1;
            // $subscription->institution_id = $institution->id;
            // $subscription->start_date = now();
            // $subscription->status = 1;
            // $subscription->save();
        }

        $response = [
            'success' => 'Institution has been added Successfully'
        ] ;

        return response($response, 200);
    }


    public function validate_user_school()
    {
        $validate_school = Institution::where('user_id', Auth::user()->id)->first();
        $all_schools = Institution::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        if($validate_school){
            $response = [
                'success' => 'user has a school',
                'has_school' => 1,
                'school' => $validate_school,
                'schools' => $all_schools
            ];

            return response($response, 200);
        }else {
            $response = [
                'error' => 'user has no school',
                'has_school' => 0
            ];

            return response($response, 200);
        }
    }

    public function get_all_schools()
    {
        $institutions = Institution::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $response = [
            'institutions' => $institutions
        ];
        return response($response, 200);
    }

    public function get_school_details(Institution $institution)
    {
        $response = [
            'institution' => $institution
        ];

        return response($response, 200);
    }

    public function update_school_details(Request $request, Institution $institution)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|min:11',
            'address' => 'required'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }

        $institution->email = $request->get('email');
        $institution->phone = $request->get('phone');
        $institution->address = $request->get('address');
        if($request->get('currency_id') !== null){
            $institution->currency_id = $request->get('currency_id');
        }
        if($request->get('language_id') !== null) {
            $institution->language_id = $request->get('language_id');
        }
        $institution->website = $request->get('website');
        $institution->prefix_code = $request->get('prefix_code');

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $extension = $signature->getClientOriginalExtension(); // you can also use file name
            $image = Auth::user()->id.'-1-' . time() . '.' . $extension;
            $path = Env('PUBLIC_IMAGE_PATH');
            $upload = $signature->move($path, $image);

            $institution->signature = $image;
        }

        $institution->save();

        $response = [
            'success' => 'institution has been updated'
        ];

        return response($response, 200);

    }

    public function get_classes_and_teachers(Institution $institution)
    {
        $classes = Level::where('institution_id', $institution->id)->orderBy('id', 'desc')->paginate(10);
        $teachers = Teacher::where('institution_id', $institution->id)->orderBy('id', 'desc')->get();

        if($classes->count() > 0 && $teachers->count() > 0) {
            $response = [
                'classes' => $classes,
                'teachers' => $teachers
            ];

            return response($response, 200);

        } elseif($classes->count() < 1 || $teachers->count() < 1) {
            $response = [
                'error' => 'either class or teachers has not been added , Please add it ',
                'classes' => $classes,
                'teachers' => $teachers
            ];

            return response($response, 400);

        }

    }
}
