<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BlogPostSeo As ModelBlogPostSeo;
use App\Models\Admin\BlogCategory As ModelBlogCategory;
use App\Models\Admin\BlogPostCategory As ModelBlogPostCategory;

class Blogs extends Controller
{
    //
    public function index() {
        return view('admin.content.blogs.index', [
            'table_name' => encrypt(ModelBlogPostSeo::$table_name)
        ]);
    }

    public function categories() {
        return view('admin.content.blogs.categories', [
            'table_name' => encrypt(ModelBlogCategory::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $blogs = ModelBlogPostSeo::get_list($request);
        $total_list = ModelBlogPostSeo::get_total_list($request);

        $data = array();
        // $blog_categories = ModelBlogPostCategory::get_list();
        foreach ($blogs as $key => $blog) {

            $get_categories = ModelBlogPostCategory::get_categories_post($blog->postID);
            $categories = [];
            foreach($get_categories as $row => $category) {
                $categories[$row]['title'] = $category->catTitle;
            }

            $data[$key] = [
                encrypt($blog->postID),
                $blog->postTitle,
                json_encode($categories),
                format_date_table($blog->postDate),
                $key + 1 + intval($request->input('start')),
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($blogs),
            'recordsFiltered' => count($total_list),
        ]);
    }

    public function get_category_list(Request $request) {
        $blog_categories = ModelBlogCategory::get_list($request);
        $total_list = ModelBlogCategory::get_total_list($request);

        $data = array();
        foreach ($blog_categories as $key => $blog_category) {
            $data[$key] = [
                encrypt($blog_category->catID),
                $blog_category->catTitle,
                $blog_category->catSlug,
                $key + 1 + intval($request->input('start')),
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($blog_categories),
            'recordsFiltered' => count($total_list),
        ]);
    }
    
    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-blogeditform');
        return response()->json([
            'response' => view('admin.layout.forms.blog', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'blog_categories' => ModelBlogCategory::get_all(),
                'blog_post_categories' => $is_edit ? ModelBlogPostCategory::get_categories_post(decrypt($request->id)) : [],
                'blog' => $is_edit ? ModelBlogPostSeo::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function form_category(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-blogcategoryeditform');
        return response()->json([
            'response' => view('admin.layout.forms.blog-category', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'blog_category' => $is_edit ? ModelBlogCategory::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save_category(Request $request) {
        $is_edit = request()->routeIs('admin-blogcategoryupdate');

        $request->validate([
            'title' => 'required',
        ], 
        [
            'required' => 'This field is required.'
        ]);

        if($is_edit) $request->validate(['id' => 'required']);

        $request->slug = create_slug($request->title);

        if(!$is_edit) {
            $result = ModelBlogCategory::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelBlogCategory::edit($request);
            $pre_msg = 'Update';
        }

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-blogupdate');

        $request->validate([
            'title' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeywords' => 'required',
            // 'icon' => 'nullable|image',
        ], 
        [
            'required' => 'This field is required.'
        ]);
        if($request->file('icon')) $request->validate(['icon' => 'image']);
        if($is_edit) $request->validate(['id' => 'required']);
        $request->slug = create_slug($request->title);


        // $request->icloudstatus = !empty($request->icloudstatus) ? '1':'0';

        if ($request->file('icon')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('icon')->getClientOriginalExtension();
            $request->icon = $fileName;
            // $path = 'setting/' . base64_encode($request->id) . '/';
        // $request->logo = $path . $fileName;
        }

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();
        if(!$is_edit) {
            $result = ModelBlogPostSeo::insert($request);
            $request->id = $result;
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelBlogPostSeo::edit($request);
            $pre_msg = 'Update';
        }

        $result = ModelBlogPostCategory::delete_existing($request->id);
        if (!empty($request->categories)) {
            $categories = $request->categories;
            to_object($categories);

            foreach ($categories as $id => $value) {
                $request->post = $request->id;
                $request->category = decrypt($id);
                $result = ModelBlogPostCategory::insert($request);
            }
        }

        if($result && $request->file()) {
            $id = !$is_edit ? $result : $request->id;
            $path = 'blogs/' . base64_encode($id) . '/';
            $request->file('icon')->storeAs( $path, $fileName, 'public');
        }

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)($result),
                'message' => $message,
            ]
        ]);
    }
    
}
