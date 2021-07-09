<?php

namespace App\Http\Requests\Admin\CategoryBlog;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryBlogRequest extends FormRequest
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
            'name_cate' => "required|max:100|min:5|unique:category_blogs",
        ];
    }

    public function messages()
    {
        return [
            'name_cate.required' => 'Vui lòng nhập tên danh mục blog',
            'name_cate.min' => 'Tên danh mục blog tối thiểu :min ký tự',
            'name_cate.unique' => 'Danh mục blog đã tồn tại',
        ];
    }
}
