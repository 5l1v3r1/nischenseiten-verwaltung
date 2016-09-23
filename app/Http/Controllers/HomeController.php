<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Redirect to application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToDashboard(Request $request)
    {
        return redirect()->action('DashboardController@index');
    }
}
