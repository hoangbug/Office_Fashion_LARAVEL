<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\CreateBlogRequest;
use App\Models\Admin\Blog\Blog;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\CategoryBlog\CategoryBlogRepository;
use App\Traits\HandleImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use HandleImage;

    protected $blogRepository , $categoryBlogRepository;

    public function __construct(BlogRepository $blogRepository, CategoryBlogRepository $categoryBlogRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryBlogRepository = $categoryBlogRepository;
    }

    public function index()
    {
        $categoryBlogs = $this->categoryBlogRepository->getAll();
        return view('admin.pages.blog.index', compact('categoryBlogs'));
    }

    public function store(CreateBlogRequest $request)
    {
        $this->blogRepository->create($request);
        return $this->response(201, 'Thêm blog mới thành công!');
    }

    public function getList(Request $request)
    {
        $blogs = $this->blogRepository->search($request);
        return view('admin.pages.blog.list', compact('blogs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->blogRepository->destroy($id);
        return $this->response(200, 'Xóa blog thành công!');

    }
}
