<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddUserlistRequest;
use App\Http\Requests\UpdateUserlistRequest;
use App\Http\Requests\DeleteUserlistRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{

    public function insertEntry(AddUserlistRequest $request, User $user)
    {
        $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role_id' => $request->input('group_id'),
                    'note' => null,
        ]);

        if ($user) {
            return response()->json(['status' => 1, 'user' => $user]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateUserlistRequest $request, User $user)
    {
        $user = User::findOrFail($request->input('pk'));
        $user->name = $request->input('value');

        if ($user->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateEmail(UpdateUserlistRequest $request, User $user)
    {
        $user = User::findOrFail($request->input('pk'));
        $user->email = $request->input('value');

        if ($user->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNote(UpdateUserlistRequest $request, User $user)
    {
        $user = User::findOrFail($request->input('pk'));
        $user->note = $request->input('value');

        if ($user->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateRole(UpdateUserlistRequest $request, User $user)
    {
        $user = User::findOrFail($request->input('pk'));
        $user->role_id = $request->input('value');

        if ($user->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function deleteUser(DeleteUserlistRequest $request, User $user)
    {
        $user = User::findOrFail($request->input('pk'));

        if ($user->delete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
