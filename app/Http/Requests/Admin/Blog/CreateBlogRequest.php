<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
            'cate_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content_blog' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:150',
        ];
    }

    public function messages()
    {
        return [
            'cate_id.required' => 'Vui lòng chọn danh mục',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'description.required' => 'Vui lòng nhập mô tả',
            'content_blog.required' => 'Vui lòng nhập nội dung',
            'main_image.required' => 'Vui lòng chọn ảnh blog',
            'main_image.mimes' => 'Ảnh không đúng định dạng (jpeg,png,jpg,gif,svg)',
            'main_image.max' => 'Vui lòng chọn ảnh có kích thước < 150m',
        ];
    }
}
