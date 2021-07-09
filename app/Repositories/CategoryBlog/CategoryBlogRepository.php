<?php

namespace App\Repositories\CategoryBlog;

use App\Models\Admin\Blog\CategoryBlog;
use App\Repositories\BaseRepository;

class CategoryBlogRepository extends BaseRepository
{
    public function model(): string
    {
        return CategoryBlog::class;
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

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        $category = $this->model->find($id);
        $category->update($attributes);
        return $category;
    }

    public function destroy($id): bool
    {
        $category = $this->model->find($id);
        if ($category) {
            $category->destroy($id);
            return true;
        }
        return false;
    }

    public function search($request)
    {
        return $this->model->latest('id')->paginate(5);
    }
}
