<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function save_class(Request $request)
    {
        $level = new Level;
        $level->name = $request->get('name');
        $level->institution_id = $request->get('institution_id');
        $level->teacher_id = $request->get('teacher_id');
        $level->save();

        $response = [
            'success' => 'Class has been added'
        ];

        return response($response, 200);
    }
}
