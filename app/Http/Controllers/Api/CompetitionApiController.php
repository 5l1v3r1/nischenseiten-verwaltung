<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Competition;
use App\Http\Requests\AddCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use App\Http\Requests\DeleteCompetitionRequest;

class CompetitionApiController extends Controller
{

    public function insertEntry(AddCompetitionRequest $request, Competition $competition)
    {
        $competition             = new Competition;
        $competition->project_id = $request->session()->get('project.id');

        if ($competition->save())
        {
            return response()->json(['status' => 1, 'pk' => $competition->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateUrl(UpdateCompetitionRequest $request, Competition $competition)
    {

        $competition      = Competition::findOrFail($request->input('pk'));
        $competition->url = $request->input('value');

        if ($competition->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNote(UpdateCompetitionRequest $request, Competition $competition)
    {

        $competition       = Competition::findOrFail($request->input('pk'));
        $competition->note = $request->input('value');

        if ($competition->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePriority(UpdateCompetitionRequest $request, Competition $competition)
    {

        $competition           = Competition::findOrFail($request->input('pk'));
        $competition->priority = $request->input('value');

        if ($competition->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePower(UpdateCompetitionRequest $request, Competition $competition)
    {

        $competition        = Competition::findOrFail($request->input('pk'));
        $competition->power = $request->input('value');

        if ($competition->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function deleteCompetition(DeleteCompetitionRequest $request, Competition $competition)
    {

        $competition = Competition::findOrFail($request->input('pk'));

        if ($competition->delete())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
