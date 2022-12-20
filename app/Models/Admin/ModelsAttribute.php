<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ModelsAttribute extends Model
{
    public static $table_name = [
        'network' => 'models_networks',
        'storage' => 'models_storage',
        'screen_size' => 'models_screen_size',
        'case_size' => 'models_case_size',
        'watch_type' => 'models_watchtype',
        'case_material' => 'models_case_material',
        'condition' => 'models_condition',
        'processor' => 'models_processor',
        'ram' => 'models_ram',
        'connectivity' => 'models_connectivity',
        'color' => 'models_color',
        'accessories' => 'models_accessories',
        'screen_resolution' => 'models_screen_resolution',
        'lyear' => 'models_lyear',
        'catalog' => 'models_catalog',
        'pricing' => 'models_pricing',
    ];

    public static function get_pricing_list($model_id) {
        return DB::table(self::$table_name['pricing'] . ' AS p')
        ->join('mobile AS m', 'm.id', 'p.model_id')
        ->select('p.*', 'm.title')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_storage" AND d.table_id = category_storage.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }
    
    public static function get_catalog_list($model_id) {
        return DB::table(self::$table_name['catalog'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_storage" AND d.table_id = category_storage.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_storage_list($model_id) {
        return DB::table(self::$table_name['storage'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_storage" AND d.table_id = category_storage.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_condition_list($model_id) {
        return DB::table(self::$table_name['condition'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_condition" AND d.table_id = category_condition.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_network_list($model_id) {
        return DB::table(self::$table_name['network'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_networks" AND d.table_id = category_networks.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_connectivity_list($model_id) {
        return DB::table(self::$table_name['connectivity'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_connectivity" AND d.table_id = category_connectivity.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_type_list($model_id) {
        return DB::table(self::$table_name['watch_type'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_watchtype" AND d.table_id = category_watchtype.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_case_material_list($model_id) {
        return DB::table(self::$table_name['case_material'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_case_material" AND d.table_id = category_case_material.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_case_size_list($model_id) {
        return DB::table(self::$table_name['case_size'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_case_size" AND d.table_id = category_case_size.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_color_list($model_id) {
        return DB::table(self::$table_name['color'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_color" AND d.table_id = category_color.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_accessories_list($model_id) {
        return DB::table(self::$table_name['accessories'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_accessories" AND d.table_id = category_accessories.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_screen_size_list($model_id) {
        return DB::table(self::$table_name['screen_size'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_screen_size" AND d.table_id = category_screen_size.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_screen_resolution_list($model_id) {
        return DB::table(self::$table_name['screen_resolution'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_screen_resolution" AND d.table_id = category_screen_resolution.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_lyear_list($model_id) {
        return DB::table(self::$table_name['lyear'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_lyear" AND d.table_id = category_lyear.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_processor_list($model_id) {
        return DB::table(self::$table_name['processor'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_processor" AND d.table_id = category_processor.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function get_ram_list($model_id) {
        return DB::table(self::$table_name['ram'])
        ->select('*')   
        // ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "category_ram" AND d.table_id = category_ram.id)'), '=', 0) //check if this is deleted
        ->where('model_id', $model_id)
        ->get();  
    }

    public static function delete_existing_attributes($attribute_name, $cat_id) {
        return DB::delete('DELETE FROM models_' . $attribute_name . ' where model_id = ?', [$cat_id]);
    }

    public static function insert_network($request) {
        return DB::table(self::$table_name['network'])
        ->insertGetId([
            'model_id' => $request->id,
            'network_name' => $request->name,
            'network_icon' => $request->icon,

            'plus_minus' => '',
            'fixed_percentage' => '',
            'network_price' => '',
            'network_unlock_price' => '',
            'most_popular' => '',
            'change_unlock' => '',
        ]);
    }

    public static function insert_catalog($request) {
        return DB::table(self::$table_name['catalog'])
        ->insertGetId([
            'model_id' => $request->id,
            'network' => !empty($request->network) ? $request->network : '',
            'storage' => !empty($request->storage) ? $request->storage : '',
            'connectivity' => !empty($request->connectivity) ? $request->connectivity : '',
            'watchtype' => !empty($request->watchtype) ? $request->watchtype : '',
            'case_material' => !empty($request->casematerial) ? $request->casematerial : '',
            'case_size' => !empty($request->casesize) ? $request->casesize : '',
            'ram' => !empty($request->ram) ? $request->ram : '',
            'processor' => !empty($request->processor) ? $request->processor : '',
            'screen_size' => !empty($request->screensize) ? $request->screensize : '',
            'conditions' => $request->condition,
            
            'graphics_card' => '',
            'model' => '',
        ]);
    }

    
    public static function update_catalog($request) {
        return DB::table(self::$table_name['catalog'])
        ->where('id', $request->id)
        ->update([
            'conditions' => $request->condition
        ]);
    }
    
    public static function insert_pricing($request) {
        return DB::table(self::$table_name['pricing'])
        ->insertGetId([
            'model_id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
        ]);
    }

    public static function update_pricing($request) {
        return DB::table(self::$table_name['pricing'])
        ->where('id', $request->id)
        ->update([
            'price' => $request->condition
        ]);
    }

    public static function update_network_price($request) {
        return DB::table(self::$table_name['network'])
        ->where('id', $request->id)
        ->update([
            'network_price' => $request->price
        ]);
    }
    
    public static function update_storage_price($request) {
        return DB::table(self::$table_name['storage'])
        ->where('id', $request->id)
        ->update([
            'storage_price' => $request->price
        ]);
    }

    public static function update_condition_price($request) {
        return DB::table(self::$table_name['condition'])
        ->where('id', $request->id)
        ->update([
            'condition_price' => $request->price
        ]);
    }

    public static function insert_storage($request) {
        return DB::table(self::$table_name['storage'])
        ->insertGetId([
            'model_id' => $request->id,
            'storage_size' => $request->size,
            'storage_size_postfix' => $request->unit,
            'top_seller' => $request->status,

            'plus_minus' => '',
            'fixed_percentage' => '',
            'storage_price' => '',
        ]);
    }

    public static function insert_screen_size($request) {

        return DB::table(self::$table_name['screen_size'])
        ->insertGetId([
            'model_id' => $request->id,
            'screen_size_name' => $request->size,
            'screen_size_price' => 0,
        ]);
    }

    public static function insert_case_size($request) {

        return DB::table(self::$table_name['case_size'])
        ->insertGetId([
            'model_id' => $request->id,
            'case_size' => $request->size,
            'case_size_price' => 0,
        ]);
    }

    public static function insert_type($request) {
        return DB::table(self::$table_name['watch_type'])
        ->insertGetId([
            'model_id' => $request->id,
            'watchtype_name' => $request->name,
            'disabled_network' => $request->status,
            'watchtype_price' => 0,
        ]);
    }

    public static function insert_case_material($request) {
        return DB::table(self::$table_name['case_material'])
        ->insertGetId([
            'model_id' => $request->id,
            'case_material_name' => $request->name,
            'case_material_price' => 0,
        ]);
    }

    public static function insert_processor($request) {
        return DB::table(self::$table_name['processor'])
        ->insertGetId([
            'model_id' => $request->id,
            'processor_name' => $request->name,
            'processor_price' => 0,
        ]);
    }

    public static function insert_ram($request) {
        return DB::table(self::$table_name['ram'])
        ->insertGetId([
            'model_id' => $request->id,
            'ram_size' => $request->size,
            'ram_size_postfix' => $request->unit,
            'ram_price' => 0,
        ]);
    }

    public static function insert_condition($request) {
        return DB::table(self::$table_name['condition'])
        ->insertGetId([
            'model_id' => $request->id,
            'condition_name' => $request->name,
            'condition_terms' => $request->term,

            'plus_minus' => '',
            'fixed_percentage' => '',
            'disabled_network' => 0,
            'condition_price' => 0,
        ]);
    }
}
