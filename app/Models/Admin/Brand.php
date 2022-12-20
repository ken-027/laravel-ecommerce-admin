<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Brand extends Model
{
    public static $table_name = 'brand';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'image', 'published','ordering')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('title', 'LIKE', '%' . $filter->search . '%')
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        ->select('id','title', 'image', 'published','ordering')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('title', 'LIKE', '%' . $filter->search . '%');
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }


    public static function update_publish($id) {
        $publish = 0;

        $brand = DB::table(self::$table_name)
        ->select('published')
        ->where('id', '=', $id)
        ->first();

        if(!empty($brand)) $publish = $brand->published == 0 ? 1:0;
        
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['published' => $publish]);
    }

    public static function update_ordering($id, $value) {
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['ordering' => $value]);
    }
    
    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('published', 1)
        ->groupBy('title')
        ->orderBy('ordering')
        ->get();
    }

    public static function get_list_by_ordering() {
        return DB::table(self::$table_name)
        ->select('*')
        ->orderByDesc('ordering')
        ->get();
    }

    public static function get_list_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', $id)
        ->get();
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'title' => $request->title,
            'sef_url' => $request->sefurl,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'image' => $request->icon,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'is_check_icloud' => $request->icloudstatus,
            'published' => $request->publish,
            'ordering' => 0,
        ]);
    }

    public static function edit($request) {
        $request->icon = !empty($request->file('icon')) ? $request->icon : self::get_info_by_id($request->id)->image;

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'sef_url' => $request->sefurl,
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'image' => $request->icon,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'is_check_icloud' => $request->icloudstatus,
            'published' => $request->publish,
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function update_title_by_model($object) {
        return DB::table(self::$table_name . ' AS b')
        ->join('mobile AS m', 'm.brand_id', 'b.id')
        ->where('m.id', $object->id)
        ->update(['b.title' => $object->brand]);
    }

    public static function get_id_by_url($sef_url) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('sef_url', $sef_url)
        ->first();   
    }
}
