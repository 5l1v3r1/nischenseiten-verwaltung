<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Backlink;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBacklinkRequest;
use App\Http\Requests\UpdateBacklinkRequest;
use App\Http\Requests\DeleteBacklinkRequest;
use Carbon\Carbon;
use App\Linkchecker\Checker\Checker;

class BacklinkApiController extends Controller
{

    public function insertEntry(AddBacklinkRequest $request, Backlink $backlink)
    {
        $backlink             = new Backlink;
        $backlink->project_id = $request->session()->get('project.id');
        $backlink->checked_at = Carbon::now();

        if ($backlink->save())
        {
            return response()->json(['status' => 1, 'pk' => $backlink->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateSource(UpdateBacklinkRequest $request, Backlink $backlink)
    {

        $backlink             = Backlink::findOrFail($request->input('pk'));
        $backlink->linksource = $request->input('value');

        if ($backlink->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateTarget(UpdateBacklinkRequest $request, Backlink $backlink)
    {

        $backlink             = Backlink::findOrFail($request->input('pk'));
        $backlink->linktarget = $request->input('value');

        if ($backlink->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateRelation(UpdateBacklinkRequest $request, Backlink $backlink)
    {

        $backlink           = Backlink::findOrFail($request->input('pk'));
        $backlink->relation = $request->input('value');

        if ($backlink->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateText(UpdateBacklinkRequest $request, Backlink $backlink)
    {

        $backlink           = Backlink::findOrFail($request->input('pk'));
        $backlink->linktext = $request->input('value');

        if ($backlink->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNote(UpdateBacklinkRequest $request, Backlink $backlink)
    {

        $backlink       = Backlink::findOrFail($request->input('pk'));
        $backlink->note = $request->input('value');

        if ($backlink->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function checkBacklink(UpdateBacklinkRequest $request, Backlink $backlink)
    {
        $backlink = Backlink::findOrFail($request->input('pk'));

        $source = $backlink->linksource;
        $target = $backlink->linktarget;


        $checker = new Checker($source, $target);
        $checker->check();

        $backlink->status = $checker->status;
        $backlink->found  = $checker->found;
        $backlink->checked_at = Carbon::now();
        
        $backlink->save();
        
        return response()->json(['status' => 1, 'check_status' => $checker->status, 'found' => $checker->found]);
    }

    public function deleteBacklink(DeleteBacklinkRequest $request, Backlink $backlink)
    {

        $backlink = Backlink::findOrFail($request->input('pk'));

        if ($backlink->delete())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
