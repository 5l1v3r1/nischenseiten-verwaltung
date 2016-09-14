<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\ViewCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IdeaCategory;
use Illuminate\Support\Facades\Auth;

class IdeasCategoryApiController extends Controller
{

    public function insertEntry(AddCategoryRequest $request, IdeaCategory $ideacategory)
    {

        $ideacategory          = new IdeaCategory;
        $ideacategory->user_id = Auth::user()->id;
        if ($ideacategory->save())
        {
            return response()->json(['status' => 1, 'pk' => $ideacategory->id]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function getCategories(Request $request, IdeaCategory $ideacategory)
    {
        $ideacategory = IdeaCategory::all(['id as value', 'name as text']);

        return response()->json($ideacategory);
    }

    public function updateName(UpdateCategoryRequest $request, IdeaCategory $ideacategory)
    {

        $ideacategory = IdeaCategory::findOrFail($request->input('pk'));

        $ideacategory->name = $request->input('value');

        if ($ideacategory->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function updateNotes(UpdateCategoryRequest $request, IdeaCategory $ideacategory)
    {

        $ideacategory        = IdeaCategory::findOrFail($request->input('pk'));
        $ideacategory->notes = $request->input('value');

        if ($ideacategory->save())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

    public function deleteCategory(DeleteCategoryRequest $request, IdeaCategory $ideacategory)
    {

        $ideacategory = IdeaCategory::findOrFail($request->input('pk'));

        if ($ideacategory->delete())
        {
            return response()->json(['status' => 1]);
        }
        else
        {
            return response()->json(['status' => 0]);
        }
    }

}
