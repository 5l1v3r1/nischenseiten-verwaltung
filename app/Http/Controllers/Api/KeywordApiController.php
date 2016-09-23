<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Keyword;
use App\Http\Requests\AddKeywordRequest;
use App\Http\Requests\UpdateKeywordRequest;
use App\Http\Requests\DeleteKeywordRequest;
use App\Metricstools\Api\Api;
use App\Option;

class KeywordApiController extends Controller
{
    public function insertEntry(AddKeywordRequest $request, Keyword $keyword)
    {
        $keyword = new Keyword();
        $keyword->project_id = $request->session()->get('project.id');

        if ($keyword->save()) {
            return response()->json(['status' => 1, 'pk' => $keyword->id]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->name = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateSV(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->searchvolume = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateCPC(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->cpc = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateCompetition(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->competition = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateContent(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->has_content = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNote(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));
        $keyword->note = $request->input('value');

        if ($keyword->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function checkKeyword(UpdateKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));

        $option = Option::find(1);
        $api = new Api($option->value, $keyword->name);
        $api->get_keyword_data();

        if (!is_null($api->credits_left) && $api->credits_left > -1) {
            $option->credits = $api->credits_left;
        } else {
            $option->credits = 0;
        }

        $option->save();

        if (isset($api->data['values'])) {
            $keyword->searchvolume = $api->data['values']['searchvolume'];
            $keyword->cpc = $api->data['values']['cpc'];
            $keyword->competition = $api->data['values']['competition'];
            $keyword->save();

            return response()->json(['status' => 1, 'credits_left' => $option->credits, 'keyword' => $api->data['values']]);
        } else {
            return response()->json(['status' => 0, 'credits_left' => $option->credits, 'error' => $api->error]);
        }
    }

    public function deleteKeyword(DeleteKeywordRequest $request, Keyword $keyword)
    {
        $keyword = Keyword::findOrFail($request->input('pk'));

        if ($keyword->delete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
