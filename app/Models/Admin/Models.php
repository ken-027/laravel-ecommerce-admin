<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Models extends Model
{
    public static $table_name = 'mobile';

    public static function get_list($filter, $datatable = true) {
        // 'SELECT m.*, d.title AS device_title, d.sef_url, b.title AS brand_title FROM mobile AS m LEFT JOIN devices AS d ON d.id=m.device_id LEFT JOIN brand AS b ON b.id=m.brand_id';
        // exit(var_dump($filter_by->device));
        $db = DB::table(self::$table_name . ' AS m')
        ->leftjoin('devices AS d', 'd.id', '=', 'm.device_id')
        ->leftjoin('brand AS b', 'b.id', '=', 'm.brand_id')
        ->leftjoin('categories AS c', 'c.id', '=', 'm.cat_id')
        ->select('m.*', 'd.title AS device', 'd.sef_url','b.title AS brand','m.published', 'm.ordering')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = m.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter){
            $query->where('m.title', 'LIKE', '%' . $filter->search . '%')
            ->where('b.title', 'LIKE', '%' . $filter->brand . '%')
            ->where('d.title', 'LIKE', '%' . $filter->device . '%')
            ->where('c.title', 'LIKE', '%' . $filter->category . '%');
        });
        if ($datatable) {
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

    public static function get_total_list($filter) {
        // 'SELECT m.*, d.title AS device_title, d.sef_url, b.title AS brand_title FROM mobile AS m LEFT JOIN devices AS d ON d.id=m.device_id LEFT JOIN brand AS b ON b.id=m.brand_id';
        // exit(var_dump($filter_by->device));
        $db = DB::table(self::$table_name . ' AS m')
        ->leftjoin('devices AS d', 'd.id', '=', 'm.device_id')
        ->leftjoin('brand AS b', 'b.id', '=', 'm.brand_id')
        ->leftjoin('categories AS c', 'c.id', '=', 'm.cat_id')
        ->select('m.*', 'd.title AS device', 'd.sef_url','b.title AS brand','m.published', 'm.ordering')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = m.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter){
            $query->where('m.title', 'LIKE', '%' . $filter->search . '%')
            ->where('b.title', 'LIKE', '%' . $filter->brand . '%')
            ->where('d.title', 'LIKE', '%' . $filter->device . '%')
            ->where('c.title', 'LIKE', '%' . $filter->category . '%');
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
        ->get();
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

    public static function get_list_by_ordering() {
        return DB::table(self::$table_name)
        ->select('*')
        ->orderByDesc('ordering')
        ->get();
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name . ' AS m')
        ->leftjoin('categories AS c', 'c.id', '=', 'm.cat_id')
        ->leftjoin('brand AS b', 'b.id', '=', 'm.brand_id')
        ->leftjoin('devices AS d', 'd.id', '=', 'm.device_id')
        ->select('m.*', 'c.network_title', 'c.storage_title', 'c.condition_title')
        ->where('m.id', '=', $id)
        ->first();
    }



    public static function get_list_by_($column, $id) {
     
        switch($column){
            case 'brands':
                $column = 'b.brand_id';
            break;
            case 'devices' :
                $column = 'm.device_id';
            break;
            default : 
                $column = 'm.cat_id';
            break;
        }
          
        return DB::table(self::$table_name . ' AS m')
        ->leftjoin('categories AS c', 'c.id', '=', 'm.cat_id')
        ->leftjoin('brand AS b', 'b.id', '=', 'm.brand_id')
        ->leftjoin('devices AS d', 'd.id', '=', 'm.device_id')
        ->select('m.*', 'c.network_title', 'c.storage_title', 'c.condition_title')
        ->where($column, $id)
        ->get();
    }

    public static function search($filter) {       
        return DB::table(self::$table_name . ' AS m')
        ->leftjoin('devices AS d', 'd.id', '=', 'm.device_id')
        ->leftjoin('brand AS b', 'b.id', '=', 'm.brand_id')
        ->leftjoin('categories AS c', 'c.id', '=', 'm.cat_id')
        ->select('m.*', 'd.title AS device', 'd.sef_url','b.title AS brand','m.published', 'm.ordering')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = m.id)'), '=', 0) //check if this is deleted
        ->where('m.title', 'LIKE', '%' . $filter . '%')->get();
  
       
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'title' => $request->title,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'cat_id' => $request->category,
            'device_id' => $request->device,
            'brand_id' => $request->brand,
            'model_img' => $request->icon,
            'published' => $request->publish,
            'searchable_words' => $request->searchablewords,
            
            'price' => '',
            'unlock_price' => '',
            'tooltip_device' => !empty($request->tooltipdevice) ? htmlspecialchars($request->tooltipdevice) : '',
            'tooltip_storage' => !empty($request->tooltipstorage) ? htmlspecialchars($request->tooltipstorage) : '',
            'tooltip_condition' => !empty($request->tooltipcondition) ? htmlspecialchars($request->tooltipcondition) : '',
            'tooltip_network' => !empty($request->tooltipnetwork) ? htmlspecialchars($request->tooltipnetwork) : '',
            'tooltip_colors' => !empty($request->tooltipcolors) ? htmlspecialchars($request->tooltipcolors) : '',
            'tooltip_miscellaneous' => !empty($request->tooltipmiscellaneous) ? htmlspecialchars($request->tooltipmiscellaneous) : '',
            'tooltip_accessories' => !empty($request->tooltipaccessories) ? htmlspecialchars($request->tooltipaccessories) : '',
            'top_seller' => 0,
            'ordering' => 0,
            'type' => '',
            'network_heading' => '',
            'storage_heading' => '',
            'condition_heading' => '',
        ]);
    }

    public static function edit($request) {
        $request->icon = !empty($request->file('icon')) ? $request->icon : self::get_info_by_id($request->id)->model_img;

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'description' => !empty($request->description) ? htmlspecialchars($request->description) : '',
            'meta_title' => $request->metatitle,
            'meta_desc' => $request->metadescription,
            'meta_keywords' => $request->metakeywords,
            'cat_id' => $request->category,
            'device_id' => $request->device,
            'brand_id' => $request->brand,
            'model_img' => $request->icon,
            'published' => $request->publish,
            'searchable_words' => $request->searchablewords,
        ]);
    }

    public static function update_from_import($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'price' => $request->price,
            'ordering' => $request->order,
            'title' => $request->title,
        ]);
    }

    public static function get_by($column, $id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where($column.'_id', $id)
        ->where('published', 1)
        ->orderBy('ordering')
        ->get();
    }
}
