<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\ViewProjectRequest;
use App\Metricstools\Api\Api;
use App\Option;
use Illuminate\Support\Facades\Cache;
use App\Helpers\ViewHelper;

class ProjectApiController extends Controller
{

    public function insertEntry(AddProjectRequest $request, Project $project)
    {

        $project          = new Project;
        $project->user_id = Auth::user()->id;
        $project->name    = 'http://ganze.url.zur.seite.de';

        if ($project->save())
        {
            return response()->json(['status' => 1, 'pk' => $project->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateProjectRequest $request, Project $project)
    {

        $project       = Project::findOrFail($request->input('pk'));
        $project->name = $request->input('value');

        if ($project->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateGaViewID(UpdateProjectRequest $request, Project $project)
    {

        $project             = Project::findOrFail($request->input('pk'));
        $project->ga_view_id = $request->input('value');

        if ($project->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNotes(UpdateProjectRequest $request, Project $project)
    {

        $project        = Project::findOrFail($request->input('pk'));
        $project->notes = $request->input('value');

        if ($project->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateRankings(ViewProjectRequest $request, Project $project)
    {

        $cache_name = md5(
                $request->session()->get('project.id') . '-ranking-' . $request->session()->get('project.name')
        );

        Cache::forget($cache_name);

        $option = Option::find(1);

        $api = new Api($option->value, $request->session()->get('project.name'));
        $api->get_rankings();

        if (!is_null($api->credits_left) && $api->credits_left > -1)
        {
            $option->credits = $api->credits_left;
        }
        else
        {
            $option->credits = 0;
        }

        $option->save();

        Cache::forever($cache_name, json_encode($api->data));

        return response()->json(['status' => 1, 'error' => $api->error]);
    }

    public function createSI(ViewProjectRequest $request, Project $project)
    {
        $status     = 0;
        $cache_name = md5(
                $request->session()->get('project.id') . '-si-' . $request->session()->get('project.name')
        );

        $project_url = ViewHelper::cleanUrl($request->session()->get('project.name'));
        if ($project_url === null)
        {
            return response()->json(['status' => $status, 'error' => 'Die URL konnte nicht geparsed werden!']);
        }
        $option = Option::find(1);
        $api    = new Api($option->value, $project_url);
        $api->get_searchindex_data();

        if (!is_null($api->credits_left) && $api->credits_left > -1)
        {
            $option->credits = $api->credits_left;
        }
        else
        {
            $option->credits = 0;
        }

        $option->save();

        if (isset($api->data['values']))
        {
            $status = 1;
            Cache::forget($cache_name);
            Cache::forever($cache_name, json_encode($api->data['values']));
        }

        return response()->json(['status' => $status, 'error' => $api->error]);
    }

    public function deleteProject(DeleteProjectRequest $request, Project $project)
    {
        $project_id_in_session = $request->session()->get('project.id');

        $project = Project::findOrFail($request->input('pk'));


        if ($project->delete())
        {

            if ($project_id_in_session == $request->input('pk'))
            {
                $request->session()->remove('project');
            }

            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
