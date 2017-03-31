<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreForm extends FormRequest
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
            'permission_name'   => 'required|unique:permissions',
            'route'             => 'required'
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
            'permission_name.required'      => '权限名称不能为空',
            'permission_name.unique'        => '权限名称已存在',
            'route.required'                => '路由不能为空'
        ];
    }
}
