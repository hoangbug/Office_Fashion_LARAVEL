<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryBlog\CreateCategoryBlogRequest;
use App\Http\Requests\Admin\CategoryBlog\EditCategoryBlogRequest;
use App\Repositories\CategoryBlog\CategoryBlogRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    protected $categoryBlogRepository;

    public function __construct(CategoryBlogRepository $categoryBlogRepository)
    {
        return $this->categoryBlogRepository = $categoryBlogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application
     */
    public function index()
    {
        return view('admin.pages.category-blog.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryBlogRequest $request
     * @return JsonResponse
     */
    public function store(CreateCategoryBlogRequest $request): JsonResponse
    {
        $this->categoryBlogRepository->create($request->all());
        return $this->response(201, 'Tạo danh mục blog thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $category = $this->categoryBlogRepository->getById($id);
        return $this->response(200, 'Find category successfully', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditCategoryBlogRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EditCategoryBlogRequest $request, int $id): JsonResponse
    {
        $this->categoryBlogRepository->update($id, $request->all());
        return $this->response(200, 'Cập nhật danh mục blog thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->categoryBlogRepository->destroy($id);
        return $this->response(200, 'Xóa danh mục thành công!');

    }

    public function getList(Request $request)
    {
        $categories = $this->categoryBlogRepository->search($request);
        return view('admin.pages.category-blog.list', compact('categories'));
    }
}
