<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Content;
use App\Http\Requests\AddContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Http\Requests\DeleteContentRequest;

class ContentApiController extends Controller
{
    public function insertEntry(AddContentRequest $request, Content $content)
    {
        $content = new Content();
        $content->project_id = $request->session()->get('project.id');

        if ($content->save()) {
            return response()->json(['status' => 1, 'pk' => $content->id]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateContentRequest $request, Content $content)
    {
        $content = Content::withTrashed()->findOrFail($request->input('pk'));
        $content->name = $request->input('value');

        if ($content->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNote(UpdateContentRequest $request, Content $content)
    {
        $content = Content::withTrashed()->findOrFail($request->input('pk'));
        $content->note = $request->input('value');

        if ($content->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePriority(UpdateContentRequest $request, Content $content)
    {
        $content = Content::withTrashed()->findOrFail($request->input('pk'));
        $content->priority = $request->input('value');

        if ($content->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateKeyword(UpdateContentRequest $request, Content $content)
    {
        $content = Content::withTrashed()->findOrFail($request->input('pk'));
        $content->keyword = $request->input('value');

        if ($content->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function archiveContent(DeleteContentRequest $request, Content $content)
    {
        $content = Content::findOrFail($request->input('pk'));

        if ($content->delete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function deleteContent(DeleteContentRequest $request, Content $content)
    {
        $content = Content::withTrashed()->findOrFail($request->input('pk'));

        if ($content->forceDelete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
