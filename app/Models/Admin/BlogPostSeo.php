<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BlogPostSeo extends Model
{
    public static $table_name = 'blog_posts_seo';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.postID)'), '=', 0) //check if this is deleted
        ->where('postTitle', 'LIKE', '%' . $filter->search . '%')
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->orderBy('postID', 'DESC')
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.postID)'), '=', 0) //check if this is deleted
        ->where('postTitle', 'LIKE', '%' . $filter->search . '%');
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }


    public static function update_publish($id) {
        $publish = 0;

        $brand = DB::table(self::$table_name)
        ->select('published')
        ->where('id', '=', $id)
        ->first();

        if(!empty($brand)) $publish = $brand->published == 0 ? 1:0;
        
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['published' => $publish]);
    }

    public static function update_ordering($id, $value) {
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['ordering' => $value]);
    }
    
    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->groupBy('title')
        ->get();
    }

    public static function get_list_by_ordering() {
        return DB::table(self::$table_name)
        ->select('*')
        ->orderByDesc('ordering')
        ->get();
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'postTitle' => $request->title,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'postSlug' => $request->slug,
            'postCont' => !empty($request->content) ? htmlspecialchars($request->content) : '',
            'image' => $request->icon,
            'postDate' => date('Y-m-d G:i:s'),
            'postDesc' => '',
        ]);
    }

    public static function edit($request) {
        $request->icon = !empty($request->file('icon')) ? $request->icon : self::get_info_by_id($request->id)->image;

        return DB::table(self::$table_name)
        ->where('postID', $request->id)
        ->update([
            'postTitle' => $request->title,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'postSlug' => $request->slug,
            'postCont' => !empty($request->content) ? htmlspecialchars($request->content) : '',
            'image' => $request->icon,
            // 'postDate' => date('Y-m-d G:i:s'),
            'postDesc' => '',
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('postID', '=', $id)
        ->first();
    }
}
