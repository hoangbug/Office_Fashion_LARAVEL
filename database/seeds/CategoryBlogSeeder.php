<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Blog\CategoryBlog;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $cateBlog = new CategoryBlog;
            $cateBlog->name_cate = 'category blog '.$i;
            $cateBlog->status = '1';
            $cateBlog->save();
        }
    }
}
