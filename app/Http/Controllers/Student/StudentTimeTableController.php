<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TimeTable;
use Illuminate\Http\Request;

class StudentTimeTableController extends Controller
{
    private $student;

    public function __construct()
    {
        $this->student = Student::select(['id', 'user_id', 'created_at', 'institution_id', 'level_id'])->withoutGlobalScopes()->get();
    }

    public function time_table()
    {
        return view(env('APP_THEME').'.student.pages.time-table');
    }

    public function get_student_time_table()
    {
        $student = $this->student->firstWhere('user_id', auth()->user()->id);
        $time_table = TimeTable::where('institution_id', $student->institution_id)
                                ->where('level_id', $student->level_id)
                                ->get();

        $response = [
            'time_tables' => $time_table
        ];

        return response($response, 200);
    }
}
