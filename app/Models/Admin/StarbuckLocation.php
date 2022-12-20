<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class StarBuckLocation extends Model
{
    public static $table_name = 'starbuck_location';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        // ->where('fields_type', 'LIKE', '%' . $filter->search . '%')
        // ->where(DB::raw('(fields_type LIKE ? AND title LIKE ?)', ['"%'.$filter->search.'%"', '"%'.$filter->search.'%"']),)
        ->Where(function($query) use ($filter){
            $query->where('name', 'like', '%' . $filter->search . '%')
            ->orWhere('address', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db =  DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        // ->where('fields_type', 'LIKE', '%' . $filter->search . '%')
        // ->where(DB::raw('(fields_type LIKE ? AND title LIKE ?)', ['"%'.$filter->search.'%"', '"%'.$filter->search.'%"']),)
        ->Where(function($query) use ($filter){
            $query->where('name', 'like', '%' . $filter->search . '%')
            ->orWhere('address', 'LIKE', '%' . $filter->search . '%');
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
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->orderBy('ordering')
        ->get();
    }

    public static function update_publish($id) {
        $publish = 0;

        //get the current status
        $starbuck = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($starbuck)) $publish = $starbuck->status == 0 ? 1:0;
        
        
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

    public static function get_post() {
        return DB::select('SELECT * FROM blog_post ORDER BY date_posted DESC');
    }


    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'name' => $request->name,
            'address' => $request->address,
            'map_link' => $request->googlemaplink,
            'status' => $request->publish,
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
            'ordering' => 0,
        ]);
    }
    
    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'address' => $request->address,
            'map_link' => $request->googlemaplink,
            'status' => $request->publish,
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
