<?php

namespace App\Http\Controllers;

use App\Option;
use App\Project;
use App\Backlink;
use App\Idea;
use App\Keyword;
use App\Linkchecker\Checker\Checker;
use App\Metricstools\Api\Api;
use App\Helpers\ViewHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CronjobController extends Controller
{

    /**
     * @var string
     */
    private $apikey;

    /**
     * @var Option
     */
    private $option;

    /**
     * @var int
     */
    private $backlink_ttl;

    /**
     * @var int
     */
    private $keywords_ttl;

    /**
     * @var int
     */
    private $ideas_ttl;

    /**
     * @var int
     */
    private $backlink_count;

    /**
     * @var int
     */
    private $keywords_count;

    /**
     * @var int
     */
    private $ideas_count;

    /**
     * CronjobController:__construct().
     *
     * Load important options on instaniation of class.
     */
    public function __construct()
    {
        $this->option = Option::find(1);
        $this->apikey = $this->option->value; // API Metrics

        $this->backlink_ttl = Option::find(6)->value;
        $this->backlink_count = Option::find(3)->value;

        $this->keywords_ttl = Option::find(7)->value;
        $this->keywords_count = Option::find(4)->value;

        $this->ideas_ttl = Option::find(8)->value;
        $this->ideas_count = Option::find(5)->value;
    }

    /**
     * CronjobController:rankings().
     *
     * Intended to be run once a week via cronjob. Fetches Top 500 Rankings for
     * every project url and creates a cache entry
     */
    public function rankings()
    {
        if ($this->apikey == '') {
            return;
        }

        $api = new Api($this->apikey);

        $projects = Project::whereNotNull('name')->get();

        foreach ($projects as $project)
        {
            $api->input = ViewHelper::cleanUrl($project->name);

            $api->getRankings();

            $cache_name = md5($project->id . '-ranking-' . $project->name);

            if ($api->status == 200 && !empty($api->data['values'])) {
                Cache::forget($cache_name);
                Cache::forever($cache_name, json_encode($api->data));

                $project->updated_at = Carbon::now();
                $project->save();
            } else {
                Log::info($project->name . ' - rankings(): keine Daten via API gefunden!');
                Cache::forget($cache_name);
            }

            sleep(1);
        }

        if (!is_null($api->credits_left)) {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    /**
     * CronjobController:keywords().
     *
     * Intended to be run once a week via cronjob. Fetches searchvolume, cpc and
     * competition for every keyword (added to projects).
     */
    public function keywords()
    {
        if ($this->apikey == '') {
            return;
        }

        $api = new Api($this->apikey);

        $keywords = Keyword::whereNotNull('name')
                ->whereRaw('DATEDIFF(NOW(),updated_at)>' . $this->keywords_ttl)
                ->take($this->keywords_count)
                ->get();

        foreach ($keywords as $keyword)
        {
            $api->input = $keyword->name;

            $api->getKeywordData();

            if ($api->status == 200 && !empty($api->data['values'])) {
                $keyword->searchvolume = $api->data['values']['searchvolume'];
                $keyword->cpc = $api->data['values']['cpc'];
                $keyword->competition = $api->data['values']['competition'];
                $keyword->save();
            } else {
                Log::info($keyword->name . ' - keywords(): keine Daten via API gefunden!');
            }

            sleep(1);
        }

        if (!is_null($api->credits_left)) {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    /**
     * CronjobController:searchindex().
     *
     * Intended to be run once a week via cronjob. Fetches the searchindex via
     * metrics.tools for every project and creates a cache entry.
     */
    public function searchindex()
    {
        if ($this->apikey == '') {
            return;
        }

        $api = new Api($this->apikey);

        $projects = Project::whereNotNull('name')->get();

        foreach ($projects as $project)
        {
            $api->input = ViewHelper::cleanUrl($project->name);

            $api->getSearchindexData();

            $cache_name = md5($project->id . '-si-' . $project->name);

            if ($api->status == 200 && !empty($api->data['values'])) {
                Cache::forget($cache_name);
                Cache::forever($cache_name, json_encode($api->data['values']));

                $project->updated_at = Carbon::now();
                $project->save();
            } else {
                Log::info($project->name . ' - searchindex(): keine Daten via API gefunden!');
                Cache::forget($cache_name);
            }

            sleep(1);
        }

        if (!is_null($api->credits_left)) {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }

    /**
     * CronjobController:searchindex().
     *
     * Intended to be run once a week via cronjob. Checks every backlink if:
     * a) its online b) target is linked
     */
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

            $backlink->status = $linkchecker->status;
            $backlink->found = $linkchecker->found;
            $backlink->checked_at = Carbon::now();
            $backlink->save();
        }
    }

    /**
     * CronjobController:ideas().
     *
     * Intended to be run once a week via cronjob. Fetches searchvolume, cpc and
     * competition for every keyword in the idea-table.
     */
    public function ideas()
    {
        if ($this->apikey == '') {
            return;
        }

        $api = new Api($this->apikey);

        $keywords = Idea::whereNotNull('name')
                ->whereRaw('DATEDIFF(NOW(),updated_at)>' . $this->ideas_ttl)
                ->take($this->ideas_count)
                ->get();

        foreach ($keywords as $keyword)
        {
            $api->input = $keyword->name;

            $api->getKeywordData();

            if ($api->status == 200 && !empty($api->data['values'])) {
                $keyword->searchvolume = $api->data['values']['searchvolume'];
                $keyword->cpc = $api->data['values']['cpc'];
                $keyword->competition = $api->data['values']['competition'];
                $keyword->save();
            } else {
                Log::info($keyword->name . ' - ideas(): keine Daten via API gefunden!');
            }

            sleep(1);
        }

        if (!is_null($api->credits_left)) {
            $this->option->credits = $api->credits_left;
            $this->option->save();
        }
    }
}
