<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Language;
use App\Models\State;
use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    public function get_details_for_registration()
    {
        $countries = Country::orderBy('id', 'desc')->get();
        $currencies = Currency::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $states = State::orderBy('id', 'asc')->get();

        $response = [
            'countries' => $countries,
            'currencies' => $currencies,
            'languages' => $languages,
            'states' => $states
        ];

        return response($response, 200);
    }
}
