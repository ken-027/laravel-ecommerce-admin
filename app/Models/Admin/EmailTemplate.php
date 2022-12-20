<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmailTemplate extends Model
{
    public static $table_name = 'mail_templates';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('type', 'LIKE', "%$filter->type%")
        ->where('subject', 'LIKE', "%$filter->search%")
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('type', 'LIKE', "%$filter->type%")
        ->where('subject', 'LIKE', "%$filter->search%");
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_type_list() {
        return DB::table(self::$table_name)
        ->select(DB::raw('DISTINCT type AS type'))
        ->get();
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

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'type' => $request->templatetype,
            'subject' => $request->subject,
            // 'content' => !empty($request->emailcontent) ? $request->emailcontent : '',
            'content' => $request->emailcontent,
            'sms_status' => $request->smssection,
            'sms_content' => $request->smscontent,
            'status' => $request->publish,
            'is_fixed' => '1',
        ]);
    }
    
    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'type' => $request->templatetype,
            'subject' => $request->subject,
            // 'content' => !empty($request->emailcontent) ? $request->emailcontent : '',
            'content' => $request->emailcontent,
            'sms_status' => $request->smssection,
            'sms_content' => $request->smscontent,
            'status' => $request->publish,
            'is_fixed' => $request->is_fixed,
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function get_template_by_type($type) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('type', $type)
        ->first();
    }
}
