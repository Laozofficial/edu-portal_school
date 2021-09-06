<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function save_institution(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
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

    }
}
