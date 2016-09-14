<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\ViewRolesRequest;
use App\Http\Requests;
use App\Role;
use App\Http\Controllers\Controller;

class RoleApiController extends Controller
{

    public function getRoles(ViewRolesRequest $request, Role $role)
    {
        $role = Role::all(['id as value', 'full_name as text']);

        return response()->json($role);
    }

}
