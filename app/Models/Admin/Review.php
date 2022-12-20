<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{
    public static $table_name = 'reviews';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use($filter) {
            $query->orWhere('name', 'LIKE', "%$filter->search%")
            ->orWhere('email', 'like', "%$filter->search%")
            ->orWhere('city', 'like', "%$filter->search%")
            ->orWhere('zip_code', 'like', "%$filter->search%")
            ->orWhere('state', 'like', "%$filter->search%");
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use($filter) {
            $query->orWhere('name', 'LIKE', "%$filter->search%")
            ->orWhere('email', 'like', "%$filter->search%")
            ->orWhere('city', 'like', "%$filter->search%")
            ->orWhere('zip_code', 'like', "%$filter->search%")
            ->orWhere('state', 'like', "%$filter->search%");
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
        ->where('published', 1)
        ->get();
    }

    public static function update_publish($id) {
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

    public static function update_status($id) {
        $status = 0;
        // get the current status
        $review = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($review)) $status = $review->status == 0 ? 1:0;
        
        // change the status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $status]);
    }
    

    public static function get_post() {
        return DB::select('SELECT * FROM blog_post ORDER BY date_posted DESC');
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
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zipcode,
            'device_sold' => $request->devicesold,
            'website' => $request->reviewwebsite,
            'stars' => $request->starrating,
            'content' => $request->comment,
            'date' => date('Y-m-d H:i:s', strtotime($request->date)),
            'published' => $request->publish,
            //unneccesary
            'title' => '',
            'phone' => '',
            'photo' => '',
            'status' => '1',
            'published' => '',
        ]);
    }

    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zipcode,
            'device_sold' => $request->devicesold,
            'website' => $request->reviewwebsite,
            'stars' => $request->starrating,
            'content' => $request->comment,
            'date' => date('Y-m-d H:i:s', strtotime($request->date)),
            'published' => $request->publish,
        ]);
    }
}
