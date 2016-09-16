<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller
{

    public function redirectToDashboard(Request $request)
    {
        return redirect()->action('DashboardController@index');
    }

}
