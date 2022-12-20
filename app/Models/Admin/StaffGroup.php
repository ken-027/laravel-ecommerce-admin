<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StaffGroup extends Model
{
    public static $table_name = 'staff_groups';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('name', 'LIKE', "%$filter->search%")
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('name', 'LIKE', "%$filter->search%");
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('status', 1)
        ->groupBy('name')
        ->get();
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'permissions' => json_encode($request->permissions),
            'status' => $request->status,
            //default
        ]);
    }
    
    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'permissions' => json_encode($request->permissions),
            'status' => $request->status,
        ]);
    }

    public static function update_publish($id) {
        $publish = 0;

        //get the current status
        $staff_group = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($staff_group)) $publish = $staff_group->status == 0 ? 1:0;
        
        
        //change status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $publish]);
    }
}
