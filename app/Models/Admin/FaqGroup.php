<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FaqGroup extends Model
{
    public static $table_name = 'faqs_groups';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS fg')
        ->leftjoin('categories AS c', 'c.id', '=', 'fg.cat_id')
        ->select('fg.*', 'c.title AS category')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = fg.id)'), '=', 0) //check if this is deleted
        ->where('fg.title', 'LIKE', "%$filter->search%")
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS fg')
        ->leftjoin('categories AS c', 'c.id', '=', 'fg.cat_id')
        ->select('fg.*', 'c.title AS category')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = fg.id)'), '=', 0) //check if this is deleted
        ->where('fg.title', 'LIKE', "%$filter->search%");
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function update_publish($id) {
        $publish = 0;

        //get the current status
        $category = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($category)) $publish = $category->status == 0 ? 1:0;
        
        
        //change status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $publish]);
    }

    public static function update_ordering($id, $value) {
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['ordering' => $value]);
    }

    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('status', 1)
        ->groupBy('title')
        ->orderBy('ordering')
        ->get();
    }

    public static function insert($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->insertGetId([
            'title' => $request->name,
            'cat_id' => $request->category,
            'status' => $request->publish,
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
            'ordering' => 0,
            'is_trash' => 0,
        ]);
    }
    
    public static function edit($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'title' => $request->name,
            'cat_id' => $request->category,
            'status' => $request->publish,
            'added_date' => $get_info->added_date,
            'updated_date' => date('Y-m-d G:i:s'),
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }
}
