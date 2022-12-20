<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    public static $table_name = 'contact';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use($filter) {
            $query->orWhere('name', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'like', "%$filter->search%")
            ->orWhere('email', 'like', "%$filter->search%")
            ->orWhere('phone', 'like', "%$filter->search%");
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use($filter) {
            $query->orWhere('name', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'like', "%$filter->search%")
            ->orWhere('email', 'like', "%$filter->search%")
            ->orWhere('phone', 'like', "%$filter->search%");
        });
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function update_publish($id) {
        $id = decrypt($id);
        $publish = 0;

        //get the current status
        $category = DB::table(self::$table_name)
        ->select('published')
        ->where('id', '=', $id)
        ->first();

        if(!empty($category)) $publish = $category->published == 0 ? 1:0;
        
        
        //change status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['published' => $publish]);
    }

}
