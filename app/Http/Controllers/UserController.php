<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\AutoLoginRequest;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ViewUserlistRequest;

class UserController extends Controller
{

    public function showUserlist(ViewUserlistRequest $request)
    {
        return view('users.index', [
            'userlist' => User::all(),
            'grouplist' => Role::all(),
        ]);
    }

    public function updateProfile()
    {
        return view('profile.edit', [
        ]);
    }

    public function postUpdateProfile(UpdateUserProfileRequest $request, User $user)
    {
        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (trim($request->input('password')) !== '') {
            $user->password = Hash::make($request->input('password'));
        }

        if ($user->save()) {
            $request->session()->flash('status', 'Das Profil wurde aktualisiert.');
        } else {
            $request->session()->flash('status', 'Profil wurde nicht aktualisiert.');
        }

        return redirect()->action('UserController@updateProfile');
    }

    public function loginWithID(AutoLoginRequest $request, User $user)
    {
        $request->session()->forget('project');
        Auth::login($user, true);

        return redirect()->action('DashboardController@index');
    }
}
