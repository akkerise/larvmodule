<?php

namespace App\Modules\Cms\Http\Requests\Cate;

use Illuminate\Foundation\Http\FormRequest;

class CmsEditCateRequest extends FormRequest
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
            'name' => 'required|string',
            'slug' => 'required|string|max:255',
            'order' => 'required|integer',
            'status' => 'required|integer|max:20',
            'parent_id' => 'required|integer',
            'parent_slug' => 'required|string',
            'description' => 'required|string',
            'cover' => 'mimes:jpeg,bmp,png',
            'icon' => 'mimes:jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'name.*' => ':attribute is not invalid!',
            'slug.*' => ':attribute is not invalid!',
            'order.*' => ':attribute is not invalid!',
            'status.*' => ':attribute is not invalid!',
            'parent_id.*' => ':attribute is not invalid!',
            'parent_slug.*' => ':attribute is not invalid!',
            'description.*' => ':attribute is not invalid!',
            'cover.*' => ':attribute is not invalid!',
            'icon.*' => ':attribute is not invalid!',
        ];
    }


}
