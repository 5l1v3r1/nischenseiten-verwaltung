<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\AddPartnerProgramRequest;
use App\Http\Requests\UpdatePartnerProgramRequest;
use App\Http\Requests\DeletePartnerProgramRequest;
use App\Http\Requests\ViewPartnerProgramRequest;
use App\Http\Controllers\Controller;
use App\PartnerProgram;
use Illuminate\Support\Facades\Auth;

class PartnerProgramApiController extends Controller
{

    public function insertEntry(AddPartnerProgramRequest $request, PartnerProgram $pp)
    {

        $pp          = new PartnerProgram;
        $pp->user_id = Auth::user()->id;

        if ($pp->save())
        {
            return response()->json(['status' => 1, 'pk' => $pp->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function getPartnerPrograms(Request $request, PartnerProgram $pp)
    {

        $pp = PartnerProgram::all(['id as value', 'name as text']);

        return response()->json($pp);
    }

    public function updateName(UpdatePartnerProgramRequest $request, PartnerProgram $pp)
    {

        $pp       = PartnerProgram::findOrFail($request->input('pk'));
        $pp->name = $request->input('value');

        if ($pp->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNotes(UpdatePartnerProgramRequest $request, PartnerProgram $pp)
    {

        $pp        = PartnerProgram::findOrFail($request->input('pk'));
        $pp->notes = $request->input('value');

        if ($pp->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function deletePartnerProgram(DeletePartnerProgramRequest $request, PartnerProgram $pp)
    {

        $pp = PartnerProgram::findOrFail($request->input('pk'));

        if ($pp->delete())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
