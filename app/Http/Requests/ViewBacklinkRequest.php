<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Backlink;

class ViewBacklinkRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('view', new Backlink());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                //
        ];
    }

}