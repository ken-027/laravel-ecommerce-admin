<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{
    public static $table_name = 'pages';

    public static function get_list($filter) {
        // (SELECT COUNT(d.id) FROm deleted AS d WHERE d.table_name = 'admin' AND d.table_id = a.id) = 0 
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter) {
            $query->where('title', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('url', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        // (SELECT COUNT(d.id) FROm deleted AS d WHERE d.table_name = 'admin' AND d.table_id = a.id) = 0 
        $db = DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter) {
            $query->where('title', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('url', 'LIKE', '%' . $filter->search . '%');
        });
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function update_publish($id) {
        $publish = 0;
        $model = DB::table(self::$table_name)
        ->select('published')
        ->where('id', '=', $id)
        ->first();

        if(!empty($model)) $publish = $model->published == 0 ? 1:0;
        
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['published' => $publish]);
    }

    public static function insert($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->insertGetId([
            'cat_id' => $request->category,
            'device_id' => $request->device, 
            'title' => $request->title, 
            'url' => $request->url, 
            'show_title' => $request->showtitle , 
            'is_custom_url' => $request->iscustomurl, 
            'is_open_new_window' => $request->opennewwindow,  
            'css_page_class' => $request->cssclass, 
            'module_position' => $request->moduleposition, 
            'image' => !empty($request->headerimage) ? $request->headerimage : '', 
            'image_text' => $request->imagetext, 
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'content' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'published' => $request->publish,
            'added_date' => date('Y-m-d G:i:s'),
            'updated_date' => date('Y-m-d G:i:s'),
            'slug' => '',
            'type' => '',
        ]);
    }
    
    public static function edit($request) {
        $request->icon = !empty($request->file('headerimage')) ? $request->headerimage : self::get_info_by_id($request->id)->image;
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'cat_id' => $request->category,
            'device_id' => $request->device, 
            'title' => $request->title, 
            'url' => $request->url, 
            'show_title' => $request->showtitle , 
            'is_custom_url' => $request->iscustomurl, 
            'is_open_new_window' => $request->opennewwindow,  
            'css_page_class' => $request->cssclass, 
            'module_position' => $request->moduleposition, 
            'image' => !empty($request->headerimage) ? $request->headerimage : '', 
            'image_text' => $request->imagetext, 
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'content' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'published' => $request->publish,
            'added_date' => $get_info->added_date,
            'updated_date' => date('Y-m-d G:i:s'),
            'slug' => '',
            'type' => '',
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function get_all() {
        return DB::table(self::$table_name)
        ->select('*')   
        ->groupBy('title')
        ->get();
    }
}
