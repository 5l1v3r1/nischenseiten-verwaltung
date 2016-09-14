<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ViewCategoryRequest;
use App\IdeaCategory;

class IdeasCategoryController extends Controller
{

    public function showEntries(ViewCategoryRequest $request)
    {
        return view('categories.index', [
            'categories' => IdeaCategory::all()
        ]);
    }

}
