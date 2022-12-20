<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{
    public static $table_name = 'menus';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS m')
        ->leftJoin('pages AS p', 'p.id', '=', 'm.page_id')
        ->select('m.*', 'p.title AS page_title', 'p.url AS page_url')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = m.id)'), '=', 0) //check if this is deleted
        ->where('m.position', 'LIKE', '%' . $filter->position . '%')
        ->where(function($query) use ($filter) {
            $query->Where('m.menu_name', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('p.title', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS m')
        ->leftJoin('pages AS p', 'p.id', '=', 'm.page_id')
        ->select('m.*', 'p.title AS page_title', 'p.url AS page_url')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = m.id)'), '=', 0) //check if this is deleted
        ->where('m.position', 'LIKE', '%' . $filter->position . '%')
        ->where(function($query) use ($filter) {
            $query->Where('m.menu_name', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('p.title', 'LIKE', '%' . $filter->search . '%');
        });
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function update_ordering($id, $value) {
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['ordering' => $value]);
    }
    
    public static function update_status($id) {
        $publish = 0;
        //get the current status
        $menu = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($menu)) $publish = $menu->status == 0 ? 1:0;
                
        //change status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $publish]);
    }

    public static function get_position_list() {
        return DB::table(self::$table_name)
        ->select(DB::raw('DISTINCT position'))
        ->get();
    }

    public static function insert($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->insertGetId([
            'page_id' => $request->page,
            'url' => $request->url, 
            'is_custom_url' => $request->iscustomurl, 
            'is_open_new_window' => $request->opennewwindow,  
            'menu_name' => $request->name, 
            'css_menu_class' => $request->cssclass, 
            'css_menu_class' => $request->cssclassicon , 
            'parent' => 0, 
            'ordering' => $request->order,
            'status' => $request->status,
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
            'position' => '', 
        ]);
    }
    
    public static function edit($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'page_id' => $request->page,
            'url' => $request->url, 
            'is_custom_url' => $request->iscustomurl, 
            'is_open_new_window' => $request->opennewwindow,  
            'menu_name' => $request->name, 
            'css_menu_class' => $request->cssclass, 
            'css_menu_class' => $request->cssclassicon , 
            'parent' => 0, 
            'ordering' => $request->order,
            'status' => $request->status,
            'added_date' => $get_info->added_date,
            'updated_date' => date('Y-m-d G:i:s'),
            'position' => '', 
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function get_client_menu() {
        return DB::table(self::$table_name)
        ->select('*')
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '. self::$table_name . '.id)'), '=', 0) //check if this is deleted
        ->where('status', 1)
        ->orderBy('ordering')
        ->get();
    }

    public static function get_sub_menu($parent_menu) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '. self::$table_name . '.id)'), '=', 0) //check if this is deleted
        ->where('status', 1)
        ->where('parent', $parent_menu)
        ->orderBy('ordering')
        ->get();
    }
}
