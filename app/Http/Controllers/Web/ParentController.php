<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guardian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function add_parents_view()
    {
        return view(env('APP_THEME').'.admin.pages.add-parents');
    }

    public function parent_view()
    {
        return view(env('APP_THEME').'.admin.page.parents');
    }

    public function save_parent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|unique:users',
            'phone' => 'required'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }


        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->phone = $request->get('phone');
        $user->role = 4; //role is parent
        $user->otp = mt_rand('1000', '9999');
        $user->save();


        $parent = new Guardian;
        $parent->user_id = $user->id;
        $parent->save();

        DB::table('guardian_student')->insert([
            ['guardian_id' => $parent->id, 'student_id' => $request->get('student_id')],
        ]);

        $response = [
            'success' => 'parent has been mapped to the student'
        ];

        return response($response, 200);
    }

    public function get_student_parents(Student $student)
    {
        // $parents = Gua::where('student_id', $student->id)->orderBy('id', 'desc')->get();

        // return $parents;

        // $response = [
        //     'parents' => $parents
        // ];

        // return response($response, 200);
    }

    public function get_single_parent(Guardian $parent)
    {
        $response = [
            'parent' => $parent
        ];

        return response($response, 200);
    }

    public function update_single_parent(Request $request, Guardian $parent)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422); //return error validator error
        }


        $user = User::where('id', $parent->user->id)->first();
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->save();


        $response = [
            'success' => 'parent has been update to the student'
        ];

        return response($response, 200);
    }
}
