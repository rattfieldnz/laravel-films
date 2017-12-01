<?php

namespace App\Http\Requests\API;

use App\Models\Film;
use Illuminate\Support\Facades\Auth;
use InfyOm\Generator\Request\APIRequest;

class UpdateFilmAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Film::$rules;
    }
}
