<?php

namespace App\Http\Controllers;

use App\Project;
use App\Note;
use App\Content;
use App\Competition;
use App\Keyword;
use App\Option;
use App\Backlink;
use App\Http\Requests\ViewProjectRequest;
use App\Http\Requests\ChangeProjectRequest;
use App\Http\Requests\ViewProjectlistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{

    public function showEntries(ViewProjectlistRequest $request, Project $project)
    {
        if (Auth::user()->role->level > 90)
        {
            $projects = Project::all();
        }
        else
        {
            $projects = Project::where('user_id', Auth::user()->id)->get();
        }

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    public function dashboard(ViewProjectRequest $request, Project $project)
    {
        $project_id = $request->session()->get('project.id');

        $cache_name = md5(
                $request->session()->get('project.id') . '-si-' . $request->session()->get('project.name')
        );

        $si         = json_decode(Cache::get($cache_name), true);

        return view('project.dashboard', [
            'notes'        => Note::all()->where('project_id', $project_id)->count(),
            'contentideas' => Content::all()->where('project_id', $project_id)->count(),
            'competitors'  => Competition::all()->where('project_id', $project_id)->count(),
            'keywords'     => Keyword::all()->where('project_id', $project_id)->count(),
            'metrics_si'   => $si
        ]);
    }

    public function notes(ViewProjectRequest $request)
    {
        $project_id = $request->session()->get('project.id');

        switch ($request->session()->get('project.notes.archived'))
        {
            case 1:
                $notes = Note::withTrashed()->where('project_id', $project_id)->sortByDesc("id")->get();
                break;
            default:
                $notes = Note::all()->where('project_id', $project_id)->sortByDesc("id");
        }


        return view('project.notes', [
            'notes' => $notes
        ]);
    }

    public function content(ViewProjectRequest $request, Project $project)
    {

        $project_id = $request->session()->get('project.id');

        switch ($request->session()->get('project.content.archived'))
        {
            case 1:
                $content = Content::withTrashed()->where('project_id', $project_id)->sortByDesc("id")->get();
                break;
            default:
                $content = Content::all()->where('project_id', $project_id)->sortByDesc("id");
        }

        return view('project.content', [
            'content' => $content
        ]);
    }

    public function competition(ViewProjectRequest $request, Project $project)
    {

        $project_id = $request->session()->get('project.id');

        switch ($request->session()->get('project.competition.archived'))
        {
            case 1:
                $competition = Competition::withTrashed()->where('project_id', $project_id)->sortByDesc("id")->get();
                break;
            default:
                $competition = Competition::all()->where('project_id', $project_id)->sortByDesc("id");
        }

        return view('project.competition', [
            'competition' => $competition
        ]);
    }

    public function keywords(ViewProjectRequest $request, Project $project)
    {

        $project_id = $request->session()->get('project.id');

        switch ($request->session()->get('project.keywords.archived'))
        {
            case 1:
                $keywords = Keyword::withTrashed()->where('project_id', $project_id)->sortByDesc("id")->get();
                break;
            default:
                $keywords = Keyword::all()->where('project_id', $project_id)->sortByDesc("id");
        }

        return view('project.keywords', [
            'keyword' => $keywords,
        ]);
    }

    public function backlinks(ViewProjectRequest $request, Project $project)
    {

        $project_id = $request->session()->get('project.id');

        $backlinks = Backlink::all()->where('project_id', $project_id)->sortByDesc("id");


        return view('project.backlinks', [
            'backlinks' => $backlinks,
        ]);
    }

    public function rankings(ViewProjectRequest $request, Project $project)
    {

        $cache_name = md5(
                $request->session()->get('project.id') . '-ranking-' . $request->session()->get('project.name')
        );

        $keywords = json_decode(Cache::get($cache_name), true);

        if (isset($keywords['values']))
        {
            $keywords = $keywords['values'];
        }
        else
        {
            $keywords = [];
        }
        return view('project.ranking', [
            'keywords' => $keywords,
            'option'   => Option::find(1)
        ]);
    }

    public function chooseProject(ChangeProjectRequest $request, Project $project)
    {
        $request->session()->put('project.id', $project->id);
        $request->session()->put('project.name', $project->name);
        return redirect()->action('ProjectController@dashboard');
    }

    public function showArchivedNotes(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.notes.archived', 1);
        return redirect()->action('ProjectController@notes');
    }

    public function hideArchivedNotes(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.notes.archived', 0);
        return redirect()->action('ProjectController@notes');
    }

    public function showArchivedContent(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.content.archived', 1);
        return redirect()->action('ProjectController@content');
    }

    public function hideArchivedContent(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.content.archived', 0);
        return redirect()->action('ProjectController@content');
    }

    public function showArchivedKeywords(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.keywords.archived', 1);
        return redirect()->action('ProjectController@keywords');
    }

    public function hideArchivedKeywords(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.keywords.archived', 0);
        return redirect()->action('ProjectController@keywords');
    }

    public function showArchivedCompetition(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.competition.archived', 1);
        return redirect()->action('ProjectController@competition');
    }

    public function hideArchivedCompetition(ViewProjectRequest $request, Project $project)
    {
        $request->session()->put('project.competition.archived', 0);
        return redirect()->action('ProjectController@competition');
    }

}
