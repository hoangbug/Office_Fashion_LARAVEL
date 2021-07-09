<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class EditBlogRequest extends FormRequest
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
        $arr = [
            'cate_blog_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content_blog' => 'required',
            'views' => 'required',
            'status' => 'required',
        ];
        if ($this->main_image != null) {
            $arr['main_image'] = 'required';
        }

        return $arr;
    }
}
