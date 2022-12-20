<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;

class Admin extends Model
{
    public static $table_name = 'admin';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS a')
        ->leftjoin('staff_groups AS sg', 'sg.id', '=', 'a.group_id')
        ->select('a.*', 'sg.name AS group_name')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = a.id)'), '=', 0) //check if this is deleted
        ->where('a.type', '!=', 'super_admin')
        ->where(function($query) use($filter) {
            $query->orWhere('a.username', 'like', "%$filter->search%")
            ->orWhere('a.email', 'like', "%$filter->search%");
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS a')
        ->leftjoin('staff_groups AS sg', 'sg.id', '=', 'a.group_id')
        ->select('a.*', 'sg.name AS group_name')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = a.id)'), '=', 0) //check if this is deleted
        ->where('a.type', '!=', 'super_admin')
        ->where(function($query) use($filter) {
            $query->orWhere('a.username', 'like', "%$filter->search%")
            ->orWhere('a.email', 'like', "%$filter->search%");
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

    public static function get_account_by_username($username) {
        return DB::table(self::$table_name . ' AS a')
        ->join('staff_groups AS sg', 'sg.id', 'a.group_id')
        ->select('a.*', 'sg.name AS group_name', 'sg.permissions')
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = a.id)'), '=', 0) //check if this is deleted
        ->where('a.email', '=', $username)
        ->get();
    }

    public static function get_account_by_id($id) {     
        return DB::table(self::$table_name)
        ->select('*')
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('id', '=', $id)
        ->first();
    }

    public static function update_user($request) {
        return DB::table(self::$table_name)
        ->where('id', '=', $request->id)
        ->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
    }

    public static function update_user_password($request) {
        return DB::table(self::$table_name)
        ->where('id', '=', $request->id)
        ->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->newpassword),
        ]);
    }

    public static function update_password($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'password' => Hash::make($request->password),
        ]);
    }

    public static function insert($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->insertGetId([
            'group_id' => $request->group,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            //default
            'name' => '',
            'type' => 'admin',
            'pass_change_token' => 'admin',
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
        ]);
    }
    
    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'group_id' => $request->group,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'updated_date' => date('Y-m-d G:i:s'),
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function update_status($id) {
        $status = 0;
        // get the current status
        $customer = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($customer)) $status = $customer->status == 0 ? 1:0;
        
        // change the status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $status]);
    }
}
