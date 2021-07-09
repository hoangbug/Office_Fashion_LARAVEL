<?php

namespace App\Http\Requests\Admin\CategoryBlog;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryBlogRequest extends FormRequest
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
            'name_cate' =>"required|min:5|unique:category_blogs,name_cate,".$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name_cate.required' => 'Vui lòng nhập tên category blog',
            'name_cate.min' => 'Tên category blog tối thiểu :min ký tự',
            'name_cate.unique' => 'Category blog đã tồn tại',
        ];
    }
}
