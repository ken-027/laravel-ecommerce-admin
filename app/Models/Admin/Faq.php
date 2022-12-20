<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Faq extends Model
{
    public static $table_name = 'faqs';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS f')
        ->leftjoin('faqs_groups AS fg', 'fg.id', '=', 'f.group_id')
        ->select('f.*', 'fg.title AS group_title')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = f.id)'), '=', 0) //check if this is deleted
        ->where('f.title', 'LIKE', "%$filter->search%")
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS f')
        ->leftjoin('faqs_groups AS fg', 'fg.id', '=', 'f.group_id')
        ->select('f.*', 'fg.title AS group_title')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = f.id)'), '=', 0) //check if this is deleted
        ->where('f.title', 'LIKE', "%$filter->search%");
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
    
    public static function insert($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->insertGetId([
            'group_id' => $request->group,
            'title' => $request->question,
            'description' => !empty($request->answer) ? htmlspecialchars($request->answer) : '',
            'status' => $request->publish,
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
            'ordering' => 0,
        ]);
    }
    
    public static function edit($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'group_id' => $request->group,
            'title' => $request->question,
            'description' => !empty($request->answer) ? htmlspecialchars($request->answer) : '',
            'status' => $request->publish,
            'added_date' => $get_info->added_date,
            'updated_date' => date('Y-m-d G:i:s'),
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', $id)
        ->first();
    }

    public static function get_list_by_group($group_id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('group_id', $group_id)
        ->orderBy('ordering')
        ->get(); 
    }
}
