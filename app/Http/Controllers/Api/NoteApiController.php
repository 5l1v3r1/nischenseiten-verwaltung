<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Note;
use App\Http\Requests\AddNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Requests\DeleteNoteRequest;

class NoteApiController extends Controller
{
    public function insertEntry(AddNoteRequest $request, Note $note)
    {
        $note = new Note();

        $note->project_id = $request->session()->get('project.id');

        if ($note->save()) {
            return response()->json(['status' => 1, 'pk' => $note->id]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateName(UpdateNoteRequest $request, Note $note)
    {
        $note = Note::withTrashed()->findOrFail($request->input('pk'));
        $note->name = $request->input('value');

        if ($note->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateDeadline(UpdateNoteRequest $request, Note $note)
    {
        $note = Note::withTrashed()->findOrFail($request->input('pk'));
        $note->deadline = $request->input('value');

        if ($note->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateContent(UpdateNoteRequest $request, Note $note)
    {
        $note = Note::withTrashed()->findOrFail($request->input('pk'));
        $note->note = $request->input('value');

        if ($note->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updatePriority(UpdateNoteRequest $request, Note $note)
    {
        $note = Note::withTrashed()->findOrFail($request->input('pk'));
        $note->priority = $request->input('value');

        if ($note->save()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function archiveNote(DeleteNoteRequest $request, Note $note)
    {
        $note = Note::findOrFail($request->input('pk'));

        if ($note->delete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function deleteNote(DeleteNoteRequest $request, Note $note)
    {
        $note = Note::withTrashed()->findOrFail($request->input('pk'));

        if ($note->forceDelete()) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
