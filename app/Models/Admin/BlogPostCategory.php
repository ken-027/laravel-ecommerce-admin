<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BlogPostCategory extends Model
{
    public static $table_name = 'blog_post_cats';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.catID)'), '=', 0) //check if this is deleted
        ->where('catTitle', 'LIKE', '%' . $filter->search . '%')
        ->orwhere('catSlug', 'LIKE', '%' . $filter->search . '%')
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.catID)'), '=', 0) //check if this is deleted
        ->where('catTitle', 'LIKE', '%' . $filter->search . '%')
        ->orwhere('catSlug', 'LIKE', '%' . $filter->search . '%');
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->groupBy('catTitle')
        ->get();
    }

    public static function insert($request) {
        return DB::table('blog_post_cats')
        ->insertGetId([
            'postID' => $request->post,
            'catID' => $request->category,
        ]);
    }

    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('catID', $request->id)
        ->update([
            'catTitle' => $request->title,
            'catSlug' => $request->slug,
        ]);
    }

    public static function delete_existing($postID) {
        return DB::delete('DELETE FROM ' . self::$table_name . ' where postID = ?', [$postID]);
    }

    public static function get_categories_post($id) {
        return DB::table(self::$table_name . ' AS bpc')
        ->leftjoin('blog_cats AS bc', 'bc.catID', '=', 'bpc.catID')
        ->select('*')
        ->where('bpc.postID', '=', $id)
        ->get();
    }
}
