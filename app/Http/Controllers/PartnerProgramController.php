<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViewPartnerProgramRequest;
use App\PartnerProgram;

class PartnerProgramController extends Controller
{

    public function showEntries(ViewPartnerProgramRequest $request)
    {
        return view('partnerprograms.index', [
            'partnerprograms' => PartnerProgram::all()
        ]);
    }

}
