<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Device extends Model
{
    public static $table_name = 'devices';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'device_img','ordering','published')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->Where('title', 'like', '%' . $filter->search . '%')
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }



    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'device_img','ordering','published')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->Where('title', 'like', '%' . $filter->search . '%');
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
    
    public static function get_all() {
        return DB::table(self::$table_name)
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->select('*')   
        ->where('published', 1)
        ->groupBy('title')
        ->orderBy('ordering')
        ->get();
    }

    public static function update_publish($id) {
        $publish = 0;

        $device = DB::table(self::$table_name)
        ->select('published')
        ->where('id', '=', $id)
        ->first();

        if(!empty($device)) $publish = $device->published == 0 ? 1:0;
        
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['published' => $publish]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', $id)
        ->first();
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'title' => $request->title,
            'sef_url' => $request->sefurl,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'device_img' => $request->devicepicture,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'tooltip_condition' => !empty($request->tooltipcondition) ? htmlspecialchars($request->tooltipcondition) : '',
            'tooltip_network' => !empty($request->tooltipnetwork) ? htmlspecialchars($request->tooltipnetwork) : '',
            'sub_title' => !empty($request->subtitle) ? htmlspecialchars($request->subtitle) : '',
            'popular_device' => $request->isdevicepopular,
            'published' => $request->publish,
            //unneccesary fields for insert
            'ordering' => 0,
            'brand_id_noneed' => 0,
            'price' => 0.0,
            'tooltip_storage' => '',
            'tooltip_device' => '',
        ]);
    }

    public static function edit($request) {
        $request->devicepicture = !empty($request->file('devicepicture')) ? $request->devicepicture : self::get_info_by_id($request->id)->device_img;

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'sef_url' => $request->sefurl,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'device_img' => $request->devicepicture,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'tooltip_condition' => !empty($request->tooltipcondition) ? htmlspecialchars($request->tooltipcondition) : '',
            'tooltip_network' => !empty($request->tooltipnetwork) ? htmlspecialchars($request->tooltipnetwork) : '',
            'sub_title' => !empty($request->subtitle) ? htmlspecialchars($request->subtitle) : '',
            'popular_device' => $request->isdevicepopular,
            'published' => $request->publish,
        ]);
    }


    public static function update_title_by_model($object) {
        return DB::table(self::$table_name . ' AS d')
        ->join('mobile AS m', 'm.device_id', 'd.id')
        ->where('m.id', $object->id)
        ->update(['d.title' => $object->device]);
    }

    public static function get_id_by_url($sef_url) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('sef_url', $sef_url)
        ->first();   
    }
}
