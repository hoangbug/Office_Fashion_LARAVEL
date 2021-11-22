<?php

namespace App\Services;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\CategoryBlog\CategoryBlogRepository;

class BlogService extends BaseServices
{
    protected $blogRepository;

    protected $categoryBlogRepository;

    public function __construct(
        BlogRepository $blogRepository,
        CategoryBlogRepository $categoryBlogRepository
    ){
        $this->blogRepository = $blogRepository;
        $this->categoryBlogRepository = $categoryBlogRepository;
    }

    public function getListBlogs($params)
    {
        return $this->blogRepository->getAll()->toArray();
    }

    public function getListCateBlogs()
    {
        return $this->categoryBlogRepository->getAll();
    }

}
