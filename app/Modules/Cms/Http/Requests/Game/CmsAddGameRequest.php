<?php

namespace App\Modules\Cms\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class CmsAddGameRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'file' => 'max:100000',
//            'slug' => 'required|max:255',
            'logo' => 'mimes:jpeg,bmp,png',
            'cover' => 'mimes:jpeg,bmp,png',
            'thumb_share' => 'mimes:jpeg,bmp,png',
            'description' => 'required|max:1000',
            'status' => 'required|integer|between:1,2',
        ]
        ;
    }

    public function messages()
    {
        return [
           'name.*' => ':attribute is not invalid!',
           'file.max' => ':attribute is not invalid!',
//           'slug.*' => ':attribute is not invalid!',
           'logo.*' => ':attribute is not invalid!',
           'cover.*' => ':attribute is not invalid!',
           'thumb_share.*' => ':attribute is not invalid!',
           'description.*' => ':attribute is not invalid!',
           'status.*' => ':attribute is not invalid!',
       ];
    }


}
