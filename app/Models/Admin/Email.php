<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Email extends Model
{
    public static $table_name = 'inbox_mail_sms';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS ims')
        ->join('orders as o', 'o.id', 'ims.order_id')
        ->select('ims.*', 'o.order_id AS char_order_id')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = ims.id)'), '=', 0) //check if this is deleted
        // ->where('o.order_id', 'LIKE', "%$filter->order%")
        ->where(function($query) use($filter) {
            $query->orWhere('o.order_id', 'LIKE', "%$filter->search%")
            // ->orWhere('to_email', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'LIKE', "%$filter->search%")
            ->orWhere('sms_phone', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'LIKE', "%$filter->search%")
            ->orWhere('o.order_id', 'LIKE', "%$filter->search%")
            ->orWhere('visitor_ip', 'LIKE', "%$filter->search%");
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS ims')
        ->join('orders as o', 'o.id', 'ims.order_id')
        ->select('ims.*', 'o.order_id AS char_order_id')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = ims.id)'), '=', 0) //check if this is deleted
        // ->where('o.order_id', 'LIKE', "%$filter->order%")
        ->where(function($query) use($filter) {
            $query->orWhere('o.order_id', 'LIKE', "%$filter->search%")
            // ->orWhere('to_email', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'LIKE', "%$filter->search%")
            ->orWhere('sms_phone', 'LIKE', "%$filter->search%")
            ->orWhere('subject', 'LIKE', "%$filter->search%")
            ->orWhere('o.order_id', 'LIKE', "%$filter->search%")
            ->orWhere('visitor_ip', 'LIKE', "%$filter->search%");
        });
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function get_orderid_list() {
        return DB::table(self::$table_name)
        ->select(DB::raw('DISTINCT order_id AS order_id'))
        ->get();
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name . ' AS ims')
        ->join('orders as o', 'o.id', 'ims.order_id')
        ->join('admin as a', 'a.id', 'ims.staff_id')
        ->join('users as u', 'u.id', 'ims.user_id')
        ->join('mail_templates as mt', 'mt.id', 'ims.template_id')
        ->select('ims.*', 
            'a.name AS staff_name', 
            'a.email AS staff_email', 
            'u.name AS customer_name', 
            'u.phone AS customer_phone', 
            'u.email AS customer_email', 
            'o.order_id AS char_order_id')   
        ->where('ims.id', $id)
        ->first();
    }

    public static function get_unread_message_by_staff($staff) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where([
            ['staff_id', $staff],
            ['is_read', 0],
        ])
        ->orderBy('date', 'DESC')
        ->get();
    }

    public static function update_read($message_id) {
        return DB::table(self::$table_name)
        ->where('id', $message_id)
        ->update(['is_read' => 1]);
    }

    // public static function update_publish($id) {
    //     $id = decrypt($id);
    //     $publish = 0;

    //     //get the current status
    //     $category = DB::table(self::$table_name)
    //     ->select('published')
    //     ->where('id', '=', $id)
    //     ->first();

    //     if(!empty($category)) $publish = $category->published == 0 ? 1:0;
        
        
    //     //change status
    //     return DB::table(self::$table_name)
    //     ->where('id', $id)
    //     ->update(['published' => $publish]);
    // }
}
