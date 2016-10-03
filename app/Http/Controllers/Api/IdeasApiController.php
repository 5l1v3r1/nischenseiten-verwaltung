<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Http\Requests\DeleteIdeaRequest;
use App\Idea;
use Illuminate\Support\Facades\Auth;
use App\Metricstools\Api\Api;
use App\Option;
use Carbon\Carbon;

class IdeasApiController extends Controller
{

    public function insertEntry(AddIdeaRequest $request, Idea $idea)
    {

        $idea          = new Idea;
        $idea->user_id = Auth::user()->id;

        if ($idea->save())
        {
            return response()->json(['status' => 1, 'pk' => $idea->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea       = Idea::findOrFail($request->input('pk'));
        $idea->name = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateSearchVolume(UpdateIdeaRequest $request, Idea $idea)
    {



        $idea               = Idea::findOrFail($request->input('pk'));
        $idea->searchvolume = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateCPC(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea      = Idea::findOrFail($request->input('pk'));
        $idea->cpc = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateBuyConversion(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea                 = Idea::findOrFail($request->input('pk'));
        $idea->buy_conversion = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePPP(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea                    = Idea::findOrFail($request->input('pk'));
        $idea->price_per_product = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateProvision(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea            = Idea::findOrFail($request->input('pk'));
        $idea->provision = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePartnerProgram(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea                     = Idea::findOrFail($request->input('pk'));
        $idea->partner_program_id = $request->input('value');

        if ($idea->save())
        {

            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateCategory(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea                   = Idea::findOrFail($request->input('pk'));
        $idea->idea_category_id = $request->input('value');

        if ($idea->save())
        {

            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateSeasonal(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea           = Idea::findOrFail($request->input('pk'));
        $idea->seasonal = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateKeywords(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea           = Idea::findOrFail($request->input('pk'));
        $idea->keywords = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateDomains(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea          = Idea::findOrFail($request->input('pk'));
        $idea->domains = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateCompetitionPower(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea                    = Idea::findOrFail($request->input('pk'));
        $idea->competition_power = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateRanking(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea          = Idea::findOrFail($request->input('pk'));
        $idea->ranking = $request->input('value');

        if ($idea->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function checkKeyword(UpdateIdeaRequest $request, Idea $idea)
    {

        $idea = Idea::findOrFail($request->input('pk'));
        $idea->updated_at   = Carbon::now();
        
        $option = Option::find(1);
        $api    = new Api($option->value, $idea->name);
        $api->get_keyword_data();

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
            $idea->searchvolume = $api->data['values']['searchvolume'];
            $idea->cpc          = $api->data['values']['cpc'];

            $idea->save();
            return response()->json(['status' => 1, 'credits_left' => $option->credits, 'keyword' => $api->data['values']]);
        }
        else
        {
            return response()->json(['status' => 0, 'credits_left' => $option->credits, 'error' => $api->error]);
        }
    }

    public function deleteIdea(DeleteIdeaRequest $request, Idea $idea)
    {

        $idea = Idea::findOrFail($request->input('pk'));

        if ($idea->delete())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
