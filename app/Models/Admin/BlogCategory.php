<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BlogCategory extends Model
{
    public static $table_name = 'blog_cats';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.catID)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter){
            $query->where('catTitle', 'LIKE', '%' . $filter->search . '%')
            ->where('catSlug', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }



    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.catID)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter){
            $query->where('catTitle', 'LIKE', '%' . $filter->search . '%')
            ->where('catSlug', 'LIKE', '%' . $filter->search . '%');
        });
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
        return DB::table(self::$table_name)
        ->insertGetId([
            'catTitle' => $request->title,
            'catSlug' => $request->slug,
        ]);
    }

    public static function insert_post_categ($post_id, $cat_id) {
        return DB::table('blog_post_cats')
        ->insertGetId([
            'postID' => $post_id,
            'catID' => $cat_id,
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

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('catID', '=', $id)
        ->first();
    }
}
