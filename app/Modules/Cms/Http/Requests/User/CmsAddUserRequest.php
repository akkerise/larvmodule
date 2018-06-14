<?php

namespace App\Modules\Cms\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CmsAddUserRequest extends FormRequest
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
            'role_id' => 'required|integer',
            'fullname' => 'required|max:255',
            'username' => 'required|unique:h5_users|max:255',
            'email' => 'required|unique:h5_users|max:255',
            'password' => 'required|max:100',
            'birthday' => 'required|max:255',
            'mobile' => 'required|max:12',
            'address' => 'required|max:255',
            'avatar' => 'mimes:jpeg,bmp,png',
            'gender' => 'required|integer',
            'status' => 'required|integer|between:1,2',
        ];
    }

    public function messages()
    {
        return [
          'role_id.*' => ':attribute is not invalid!',
           'fullname.*' => ':attribute is not invalid!',
           'username.*' => ':attribute is not invalid!',
           'email.*' => ':attribute is not invalid!',
           'password.*' => ':attribute is not invalid!',
           'birthday.*' => ':attribute is not invalid!',
           'mobile.*' => ':attribute is not invalid!',
           'address.*' => ':attribute is not invalid!',
           'avatar.*' => ':attribute is not invalid!',
           'gender.*' => ':attribute is not invalid!',
           'status.*' => ':attribute is not invalid!',
       ];
    }


}
