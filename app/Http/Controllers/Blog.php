<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog As ModelBlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Blog extends Controller
{
    //
    public function index() {
        $data = [
            'get_post' => ModelBlog::get_post(),
            'get_recent_post' => ModelBlog::get_recent_post(),
            'get_post_cat_by_blog' => ModelBlog::get_post_category_by_blog(),
            'get_categories' => ModelBlog::get_catogires(),
        ];

        // return response()->json($res);

        return view('sub-pages.blog.index', $data);
    }

    public function get_post($id) {
        $blog_id = Crypt::decryptString($id);

        $data = [
            'get_post' => ModelBlog::get_post_by_id($blog_id),
            'get_recent_post' => ModelBlog::get_recent_post(),
            'get_post_cat_by_blog' => ModelBlog::get_post_category_by_blog(),
            'get_categories' => ModelBlog::get_catogires(),
        ];

        return view('sub-pages.blog.view-blog', $data);
    }

    public function category($category) {
        $data = [
            'get_post' => ModelBlog::get_post_by_cat($category),
            'get_recent_post' => ModelBlog::get_recent_post(),
            'get_post_cat_by_blog' => ModelBlog::get_post_category_by_blog(),
            'get_categories' => ModelBlog::get_catogires(),
        ];

        // return response()->json($res);

        return view('sub-pages.blog.index', $data);
    }
}
