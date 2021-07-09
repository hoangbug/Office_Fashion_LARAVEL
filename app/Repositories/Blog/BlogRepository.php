<?php

namespace App\Repositories\Blog;

use App\Models\Admin\Blog\Blog;
use App\Repositories\BaseRepository;
use App\Traits\HandleImage;

class BlogRepository extends BaseRepository
{
    use HandleImage;
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return Blog::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function getWithPaginate($quantity = 5)
    {
        return $this->model->latest('id')->paginate($quantity);
    }

    public function create($request)
    {
        $main_image = $this->moveImage($request->file('main_image'), $this->path);
        $blog = Blog::create([
            'cate_id' => $request->cate_id,
            'user_id' => session('user_id'),
            'title' => $request->title,
            'main_image'=> $main_image,
            'description'=> $request->description,
            'content_blog'=> $request->content_blog,
            'views'=> 0,
            'status' => 1
        ]);
        if($blog){
            return true;
        }
        return false;
    }

    public function update($id, $attributes)
    {

    }

    public function destroy($id): bool
    {
        $blog = $this->model->find($id);
        if ($blog) {
            $blog->destroy($id);
            $this->deleteImage($blog->main_image, $this->path);
            return true;
        }
        return false;
    }

    public function search($request)
    {
        return $this->model->latest('id')->paginate(5);
    }
}
