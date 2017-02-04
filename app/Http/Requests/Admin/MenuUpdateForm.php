<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuUpdateForm extends FormRequest
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
            'parent_id'         => 'required',
            'menu_name'         => 'required',
            'uri'               => 'is_route'
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
            'parent_id.required'      => '上级菜单不能为空',
            'menu_name.required'      => '菜单名称不能为空',
            'uri.is_route'            => 'uri错误'
        ];
    }
}
