<?php

namespace app\Http\Controllers;

use App\Http\Requests\ViewCategoryRequest;
use App\IdeaCategory;

class IdeasCategoryController extends Controller
{
    /**
     * Show the categories.
     *
     * @param \App\Http\Requests\ViewCategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showEntries(ViewCategoryRequest $request)
    {
        return view('categories.index', [
            'categories' => IdeaCategory::all(),
        ]);
    }
}
