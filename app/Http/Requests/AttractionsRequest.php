<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AttractionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'body' => 'required|min:12',
        ];
        $photos = count($this->input('photo'));
        foreach(range(0, $photos) as $index) {
            $rules['photo.' . $index] = 'image|mimes:jpeg,bmp,png';
        }
        return $rules;
    }
}
