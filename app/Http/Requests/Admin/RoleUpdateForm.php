<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleUpdateForm extends FormRequest
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
            'role_name' => 'required|unique:roles,role_name,'.Request::get('role_id').',role_id'
        ];
    }

    /**
     * 自定义消息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_name.required'     => '角色名不能为空',
            'role_name.unique'       => '角色名已存在'
        ];
    }
}
