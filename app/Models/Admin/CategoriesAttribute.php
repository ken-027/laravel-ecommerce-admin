<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CategoriesAttribute extends Model
{
    public static $table_name = [
        'network' => 'category_networks',
        'storage' => 'category_storage',
        'screen_size' => 'category_screen_size',
        'case_size' => 'category_case_size',
        'watch_type' => 'category_watchtype',
        'case_material' => 'category_case_material',
        'condition' => 'category_condition',
        'processor' => 'category_processor',
        'ram' => 'category_ram',
        'connectivity' => 'category_connectivity',
        'color' => 'category_color',
        'accessories' => 'category_accessories',
        'screen_resolution' => 'category_screen_resolution',
        'lyear' => 'category_lyear',
    ];

    public static function get_storage_list($cat_id) {
        return DB::table(self::$table_name['storage'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_storage" AND d.table_id = category_storage.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_condition_list($cat_id) {
        return DB::table(self::$table_name['condition'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_condition" AND d.table_id = category_condition.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_network_list($cat_id) {
        return DB::table(self::$table_name['network'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_networks" AND d.table_id = category_networks.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_connectivity_list($cat_id) {
        return DB::table(self::$table_name['connectivity'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_connectivity" AND d.table_id = category_connectivity.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_type_list($cat_id) {
        return DB::table(self::$table_name['watch_type'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_watchtype" AND d.table_id = category_watchtype.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_case_material_list($cat_id) {
        return DB::table(self::$table_name['case_material'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_case_material" AND d.table_id = category_case_material.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_case_size_list($cat_id) {
        return DB::table(self::$table_name['case_size'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_case_size" AND d.table_id = category_case_size.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_color_list($cat_id) {
        return DB::table(self::$table_name['color'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_color" AND d.table_id = category_color.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_accessories_list($cat_id) {
        return DB::table(self::$table_name['accessories'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_accessories" AND d.table_id = category_accessories.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_screen_size_list($cat_id) {
        return DB::table(self::$table_name['screen_size'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_screen_size" AND d.table_id = category_screen_size.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_screen_resolution_list($cat_id) {
        return DB::table(self::$table_name['screen_resolution'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_screen_resolution" AND d.table_id = category_screen_resolution.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_lyear_list($cat_id) {
        return DB::table(self::$table_name['lyear'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_lyear" AND d.table_id = category_lyear.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_processor_list($cat_id) {
        return DB::table(self::$table_name['processor'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_processor" AND d.table_id = category_processor.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function get_ram_list($cat_id) {
        return DB::table(self::$table_name['ram'])
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_ram" AND d.table_id = category_ram.id)'), '=', 0) //check if this is deleted
        ->where('cat_id', $cat_id)
        ->get();  
    }

    public static function delete_existing_attributes($attribute_name, $cat_id) {
        return DB::delete('DELETE FROM category_' . $attribute_name . ' where cat_id = ?', [$cat_id]);
    }

    public static function insert_network($request) {
        return DB::table(self::$table_name['network'])
        ->insertGetId([
            'cat_id' => $request->id,
            'network_name' => $request->name,
            'network_icon' => $request->icon,
            'network_price' => 0,
            'network_unlock_price' => 0,
        ]);
    }

    public static function get_network_by_id($id) {
        return DB::table(self::$table_name['network'])
        ->select('*')
        ->first();
    }

    public static function update_network($request) {
        $request->icon = empty($request->icon) ? self::get_network_by_id($request->id)->network_icon : $request->icon;

        return DB::table(self::$table_name['network'])
        ->insertGetId([
            'id' => $request->id,
            'network_name' => $request->name,
            'network_icon' => $request->icon,
        ]);
    }

    public static function insert_storage($request) {
        return DB::table(self::$table_name['storage'])
        ->insertGetId([
            'cat_id' => $request->id,
            'storage_size' => $request->size,
            'storage_size_postfix' => $request->unit,
            'top_seller' => $request->status,
            'storage_price' => 0,
        ]);
    }

    public static function insert_screen_size($request) {

        return DB::table(self::$table_name['screen_size'])
        ->insertGetId([
            'cat_id' => $request->id,
            'screen_size_name' => $request->size,
            'screen_size_price' => 0,
        ]);
    }

    public static function insert_case_size($request) {

        return DB::table(self::$table_name['case_size'])
        ->insertGetId([
            'cat_id' => $request->id,
            'case_size' => $request->size,
            'case_size_price' => 0,
        ]);
    }

    public static function insert_type($request) {
        return DB::table(self::$table_name['watch_type'])
        ->insertGetId([
            'cat_id' => $request->id,
            'watchtype_name' => $request->name,
            'disabled_network' => $request->status,
            'watchtype_price' => 0,
        ]);
    }

    public static function insert_case_material($request) {
        return DB::table(self::$table_name['case_material'])
        ->insertGetId([
            'cat_id' => $request->id,
            'case_material_name' => $request->name,
            'case_material_price' => 0,
        ]);
    }

    public static function insert_processor($request) {
        return DB::table(self::$table_name['processor'])
        ->insertGetId([
            'cat_id' => $request->id,
            'processor_name' => $request->name,
            'processor_price' => 0,
        ]);
    }

    public static function insert_ram($request) {
        return DB::table(self::$table_name['ram'])
        ->insertGetId([
            'cat_id' => $request->id,
            'ram_size' => $request->size,
            'ram_size_postfix' => $request->unit,
            'ram_price' => 0,
        ]);
    }

    public static function insert_condition($request) {
        return DB::table(self::$table_name['condition'])
        ->insertGetId([
            'cat_id' => $request->id,
            'condition_name' => $request->name,
            'condition_terms' => $request->term,
            'condition_price' => 0,
        ]);
    }


}
