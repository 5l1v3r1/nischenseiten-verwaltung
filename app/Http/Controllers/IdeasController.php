<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Idea;
use App\IdeaCategory;
use App\Http\Requests\ViewIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Support\Facades\Auth;

class IdeasController extends Controller
{

    public function updateNotes(ViewIdeaRequest $request, Idea $idea)
    {

        return view('ideas.notes', [
            'idea' => $idea
        ]);
    }

    public function postUpdateIdea(UpdateIdeaRequest $request)
    {

        $idea = Idea::findOrFail(request()->input('pk'));

        $idea->notes       = request()->input('notes');
        $idea->w_questions = request()->input('w_questions');
        $idea->competition = request()->input('competition');

        if ($idea->save())
        {
            $request->session()->flash('status', 'Erfolgreich abgespeichert');
        }

        return redirect()->route('idea.notes', ['idea' => request()->input('pk')]);
    }

    public function index(ViewIdeaRequest $request)
    {

        $where = [];

        if (Auth::user()->role->level <= 90)
        {
            $where[] = ['ideas.user_id', '=', Auth::user()->id];
        }


        $idea_category = $request->session()->get('idea-category', function()
        {
            return 0;
        });

        if ($idea_category > 0)
            $where[] = ['idea_category_id', '=', $idea_category];


        $min_sv = $request->session()->get('idea-min-sv', function()
        {
            return 0;
        });

        if ($min_sv > 0)
            $where[] = ['searchvolume', '>=', $min_sv];


        $seasonal = $request->session()->get('idea-seasonal', function()
        {
            return -1;
        });

        if ($seasonal > -1)
            $where[] = ['seasonal', '=', $seasonal];

        $sorter = $request->session()->get('idea-sorter', function()
        {
            return 0;
        });

        switch ($sorter)
        {
            case '1':
                $sorter_sql = 'ideas.updated_at';
                break;
            case '2':
                $sorter_sql = 'ideas.searchvolume';
                break;
            case '3':
                $sorter_sql = 'ideas.cpc';
                break;
            case '4':
                $sorter_sql = 'ideas.buy_conversion';
                break;
            case '5':
                $sorter_sql = 'ideas.provision';
                break;
            case '6':
                $sorter_sql = '(ideas.searchvolume*(ideas.buy_conversion/100)*ideas.cpc)';
                break;
            case '7':
                $sorter_sql = '(ideas.searchvolume*(ideas.buy_conversion/100)*ideas.price_per_product*(ideas.provision/100))';
                break;
            case '8':
                $sorter_sql = 'ideas.ranking';
                break;
            default:
                $sorter_sql = 'ideas.id';
        }

        $sorterorder = $request->session()->get('idea-sorter-order', function()
        {
            return 0;
        });

        switch ($sorterorder)
        {
            case 1:
                $order_sql = 'ASC';
                break;
            default:
                $order_sql = 'DESC';
        }


        $ideas = DB::table('ideas')
                ->select(DB::raw('ideas.*, idea_categories.id as category_id, idea_categories.name as category_name, partner_programs.id as partner_id, partner_programs.name as partner_name, ' . $sorter_sql . ' as sortorder'))
                ->where($where)
                ->leftJoin('idea_categories', 'idea_categories.id', '=', 'ideas.idea_category_id')
                ->leftJoin('partner_programs', 'partner_programs.id', '=', 'ideas.partner_program_id')
                ->orderBy('sortorder', $order_sql)
                ->paginate();

        return view('ideas.index', [
            'ideas'           => $ideas,
            'chosen_seasonal' => $seasonal,
            'chosen_sv'       => $min_sv,
            'chosen_category' => $idea_category,
            'chosen_sorter'   => $sorter,
            'chosen_order'    => $sorterorder
        ]);
    }

    public function postIdeaSearch(ViewIdeaRequest $request)
    {
        $request->session()->put('idea-category', $request->input('idea-category'));
        $request->session()->put('idea-min-sv', $request->input('idea-min-sv'));
        $request->session()->put('idea-seasonal', $request->input('idea-seasonal'));
        $request->session()->put('idea-sorter', $request->input('idea-sorter'));
        $request->session()->put('idea-sorter-order', $request->input('idea-sorter-order'));

        return redirect()->action('IdeasController@index');
    }

}
