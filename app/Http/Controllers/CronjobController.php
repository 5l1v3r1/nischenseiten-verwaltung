<?php

namespace App\Http\Controllers;

use App\Option;
use App\Project;
use App\Backlink;
use App\Idea;
use App\Keyword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Linkchecker\Checker\Checker;
use App\Metricstools\Api\Api;
use Illuminate\Support\Facades\Cache;
use App\Helpers\ViewHelper;
use Illuminate\Support\Facades\Log;

class CronjobController extends Controller
{

    private $apikey;
    private $option;
    private $backlink_ttl;
    private $keywords_ttl;
    private $ideas_ttl;
    private $backlink_count;
    private $keywords_count;
    private $ideas_count;

    public function __construct()
    {
        $this->option = Option::find(1);
        $this->apikey = $this->option->value; // API Metrics

        $this->backlink_ttl   = Option::find(6)->value;
        $this->backlink_count = Option::find(3)->value;

        $this->keywords_ttl   = Option::find(7)->value;
        $this->keywords_count = Option::find(4)->value;

        $this->ideas_ttl   = Option::find(8)->value;
        $this->ideas_count = Option::find(5)->value;
    }

    //once a week
    public function rankings()
    {

        if ($this->apikey == '')
            return;

        $api = new Api($this->apikey);

        $projects = Project::whereNotNull('name')->get();

        foreach ($projects as $project)
        {
            $api->input = ViewHelper::cleanUrl($project->name);

            $api->get_rankings();

            $cache_name = md5($project->id . '-ranking-' . $project->name);

            if ($api->status == 200 && !empty($api->data['values']))
            {
                Cache::forget($cache_name);
                Cache::forever($cache_name, json_encode($api->data));

                $project->updated_at = Carbon::now();
                $project->save();
            }
            else
            {
                Log::info($project->name . ' - rankings(): keine Daten via API gefunden!');
                Cache::forget($cache_name);
            }
        }


        if (!is_null($api->credits_left))
        {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    //once a weak
    public function keywords()
    {
        if ($this->apikey == '')
            return;

        $api = new Api($this->apikey);

        $keywords = Keyword::whereNotNull('name')
                ->whereRaw('DATEDIFF(NOW(),updated_at)>' . $this->keywords_ttl)
                ->take($this->keywords_count)
                ->get();

        foreach ($keywords as $keyword)
        {
            $api->input = $keyword->name;

            $api->get_keyword_data();

            if ($api->status == 200 && !empty($api->data['values']))
            {
                $keyword->searchvolume = $api->data['values']['searchvolume'];
                $keyword->cpc          = $api->data['values']['cpc'];
                $keyword->competition  = $api->data['values']['competition'];
                $keyword->save();
            }
            else
            {
                Log::info($keyword->name . ' - keywords(): keine Daten via API gefunden!');
            }
        }

        if (!is_null($api->credits_left))
        {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    //once a week
    public function searchindex()
    {
        if ($this->apikey == '')
            return;

        $api = new Api($this->apikey);

        $projects = Project::whereNotNull('name')->get();

        foreach ($projects as $project)
        {
            $api->input = ViewHelper::cleanUrl($project->name);

            $api->get_searchindex_data();

            $cache_name = md5($project->id . '-si-' . $project->name);

            if ($api->status == 200 && !empty($api->data['values']))
            {
                Cache::forget($cache_name);
                Cache::forever($cache_name, json_encode($api->data['values']));

                $project->updated_at = Carbon::now();
                $project->save();
            }
            else
            {
                Log::info($project->name . ' - searchindex(): keine Daten via API gefunden!');
                Cache::forget($cache_name);
            }
        }

        if (!is_null($api->credits_left))
        {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    public function backlinks()
    {

        $backlinks = Backlink::whereNotNull('linksource')
                ->whereNotNull('linktarget')
                ->whereRaw('DATEDIFF(NOW(),checked_at)>' . $this->backlink_ttl)
                ->take($this->backlink_count)
                ->select(['id', 'linksource', 'linktarget', 'checked_at'])
                ->get();

        $linkchecker = new Checker();

        foreach ($backlinks as $backlink)
        {
            $linkchecker->source = $backlink->linksource;
            $linkchecker->target = $backlink->linktarget;
            $linkchecker->check();

            $backlink->status     = $linkchecker->status;
            $backlink->found      = $linkchecker->found;
            $backlink->checked_at = Carbon::now();
            $backlink->save();
        }
    }

    public function ideas()
    {
        if ($this->apikey == '')
            return;

        $api = new Api($this->apikey);

        $keywords = Idea::whereNotNull('name')
                ->whereRaw('DATEDIFF(NOW(),updated_at)>' . $this->ideas_ttl)
                ->take($this->ideas_count)
                ->get();

        foreach ($keywords as $keyword)
        {
            $api->input = $keyword->name;

            $api->get_keyword_data();

            if ($api->status == 200 && !empty($api->data['values']))
            {
                $keyword->searchvolume = $api->data['values']['searchvolume'];
                $keyword->cpc          = $api->data['values']['cpc'];
                $keyword->competition  = $api->data['values']['competition'];
                $keyword->save();
            }
            else
            {
                Log::info($keyword->name . ' - ideas(): keine Daten via API gefunden!');
            }
        }

        if (!is_null($api->credits_left))
        {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

}
