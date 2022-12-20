<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Session extends Model
{
    public static $table_name = 'sessions';

    // public static function get_list($filter) {
    //     return DB::table(self::$table_name . ' AS a')
    //     ->leftjoin('staff_groups AS sg', 'sg.id', '=', 'a.group_id')
    //     ->select('*', 'sg.name AS group_name')   
    //     ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = a.id)'), '=', 0) //check if this is deleted
    //     ->where([
    //         ['a.type', '!=', 'super_admin'],
    //         ['a.username', 'LIKE', '%' . $filter->search . '%'],
    //         ['a.email', 'LIKE', '%' . $filter->search . '%']
    //     ])
    //     ->limit($filter->limit)
    //     ->get();
    // }
    
    public static function add() {
        return DB::insert('INSERT INTO ' . self::$table_name . '(user_id, ip_address, user_agent, payload, last_activiy) VALUES(?, ?)', [$table_name, $table_id]);
    }

    public static function get() {
        
    }
}
