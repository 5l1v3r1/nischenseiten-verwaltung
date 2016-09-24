<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    /**
     * Redirect to application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToDashboard()
    {
        return redirect()->action('DashboardController@index');
    }
}
