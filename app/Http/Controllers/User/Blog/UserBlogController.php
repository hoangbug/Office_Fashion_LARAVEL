<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    protected $blogService;

    public function __construct(
        BlogService $blogService
    )
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application
     */
    public function index(Request $request)
    {
        return view('User.pages.blog.index');
    }
}
