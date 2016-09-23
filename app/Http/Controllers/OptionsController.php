<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use App\Metricstools\Api\Api;

class OptionsController extends Controller
{
    public function updateOptions()
    {
        return view('options.edit', [
            'options' => Option::all(),
        ]);
    }

    public function postUpdateoptions(Request $request, Option $option)
    {
        $errors = [];
        $errors_api = [];

        $option = Option::find(1);
        $option->value = $request->input('apimetrics');

        if (!$option->save()) {
            $errors_api[] = 'API Metrics konnte nicht abgespeichert werden.';
        }

        if ($request->input('apimetrics') != '') {
            $api = new Api($option->value);
            $api->get_credit_count();

            if (!is_null($api->credits_left) && $api->credits_left > -1) {
                $option->credits = $api->credits_left;
            } else {
                $option->credits = 0;
            }

            if ($api->error != '') {
                $errors_api[] = 'API Metrics antwortet mit: '.$api->error;
            }
        } else {
            $option->credits = 0;
        }

        $option->save();

        $option = Option::find(3);
        $option->value = $request->input('backlink_count');
        $option->save();

        $option = Option::find(4);
        $option->value = $request->input('keyword_count');
        $option->save();

        $option = Option::find(5);
        $option->value = $request->input('idea_count');
        $option->save();

        $option = Option::find(6);
        $option->value = $request->input('backlink_ttl');
        $option->save();

        $option = Option::find(7);
        $option->value = $request->input('keyword_ttl');
        $option->save();

        $option = Option::find(8);
        $option->value = $request->input('idea_ttl');
        $option->save();

        $request->session()->flash('status', 'Die Daten wurden erfolgreich aktualisiert');

        return redirect()->action('OptionsController@updateOptions')->withErrors(array_merge($errors, $errors_api));
    }
}
