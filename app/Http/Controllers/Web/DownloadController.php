<?php

namespace App\Http\Controllers\Web;

use App\Exports\CountriesExport;
use App\Exports\StatesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function download_countries()
    {
        return Excel::download(new CountriesExport, 'countries.xlsx');
    }

    public function download_states()
    {
        return Excel::download(new StatesExport, 'states.xlsx');
    }
}
