<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    public static $table_name = 'categories';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'image', 'fields_type','ordering','published')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        // ->where('fields_type', 'LIKE', '%' . $filter->search . '%')
        // ->where(DB::raw('(fields_type LIKE ? AND title LIKE ?)', ['"%'.$filter->search.'%"', '"%'.$filter->search.'%"']),)
        ->Where(function($query) use ($filter){
            $query->where('title', 'like', '%' . $filter->search . '%')
            ->orWhere('fields_type', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db =  DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'image', 'fields_type','ordering','published')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        // ->where('fields_type', 'LIKE', '%' . $filter->search . '%')
        // ->where(DB::raw('(fields_type LIKE ? AND title LIKE ?)', ['"%'.$filter->search.'%"', '"%'.$filter->search.'%"']),)
        ->Where(function($query) use ($filter){
            $query->where('title', 'like', '%' . $filter->search . '%')
            ->orWhere('fields_type', 'LIKE', '%' . $filter->search . '%');
        });
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
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->groupBy('title')
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
    

    public static function get_post() {
        return DB::select('SELECT * FROM blog_post ORDER BY date_posted DESC');
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'title' => $request->categorytitle,
            'image' => $request->icon,
            'description' =>!empty($request->description) ? htmlspecialchars($request->description) : '',
            'published' => $request->publish,

            'ordering' => 0,
            'fields_type' => '',

            'tooltip_storage' => !empty($request->storagetooltip) ? htmlspecialchars($request->storagetooltip) : '', 
            'tooltip_condition' => !empty($request->conditiontooltip) ? htmlspecialchars($request->conditiontooltip) : '', 
            'tooltip_network' => !empty($request->networktooltip) ? htmlspecialchars($request->networktooltip) : '', 
            'tooltip_watchtype' => !empty($request->typetooltip) ? htmlspecialchars($request->typetooltip) : '', 
            'tooltip_case_material' => !empty($request->casematerialtooltip) ? htmlspecialchars($request->casematerialtooltip) : '', 
            'tooltip_case_size' => !empty($request->casesizetooltip) ? htmlspecialchars($request->casesizetooltip) : '', 
            'tooltip_screen_size' => !empty($request->screensizetooltip) ? htmlspecialchars($request->screensizetooltip) : '', 
            'tooltip_processor' => !empty($request->processortooltip) ? htmlspecialchars($request->processortooltip) : '', 
            'tooltip_ram' => !empty($request->ramtooltip) ? htmlspecialchars($request->ramtooltip) : '', 
            
            
            'tooltip_screen_resolution' => !empty($request->screenresolutiontooltip) ? htmlspecialchars($request->screenresolutiontooltip) : '', 
            'tooltip_color' => !empty($request->colortooltip) ? htmlspecialchars($request->colortooltip) : '', 
            'tooltip_connectivity' => !empty($request->connectivitytooltip) ? htmlspecialchars($request->connectivitytooltip) : '', 
            'tooltip_accessories' => !empty($request->accessoriestooltip) ? htmlspecialchars($request->accessoriestooltip) : '', 
            'tooltip_lyear' => !empty($request->lyeartooltip) ? htmlspecialchars($request->lyeartooltip) : '', 
            'tooltip_device' => !empty($request->devicetooltip) ? htmlspecialchars($request->devicetooltip) : '', 

            'storage_title' => !empty($request->storagetitle) ? $request->storagetitle : '', 
            'condition_title' => !empty($request->conditiontitle) ? $request->conditiontitle : '', 
            'network_title' => !empty($request->networktitle) ? $request->networktitle : '', 
            'case_size_title' => !empty($request->casesizetitle) ? $request->casesizetitle : '', 
            'type_title' => !empty($request->typetitle) ? $request->typetitle : '', 
            'case_material_title' => !empty($request->casematerialtitle) ? $request->casematerialtitle : '', 
            'processor_title' => !empty($request->processortitle) ? $request->processortitle : '', 
            'ram_title' => !empty($request->ramtitle) ? $request->ramtitle : '', 
            'screen_size_title' => !empty($request->screensizetitle) ? $request->screensizetitle : '', 
            
            'screen_resolution_title' => !empty($request->screenresolutiontitle) ? $request->screenresolutiontitle : '', 
            'connectivity_title' => !empty($request->connectivitytitle) ? $request->connectivitytitle : '', 
            'lyear_title' => !empty($request->lyeartitle) ? $request->lyeartitle : '', 
            'accessories_title' => !empty($request->accessoriestitle) ? $request->accessoriestitle : '', 
            'color_title' => !empty($request->colortitle) ? $request->colortitle : '', 
        ]);
    }

    public static function edit($request) {
        $request->icon = !empty($request->file('icon')) ? $request->icon : self::get_info_by_id($request->id)->image;

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'title' => $request->categorytitle,
            'image' => $request->icon,
            'description' => $request->description,
            'published' => $request->publish,
            'tooltip_network' => $request->attributesnetwork ? htmlspecialchars($request->networktooltip) : '',
            'tooltip_storage' => $request->attributesstorage ? htmlspecialchars($request->storagetooltip) : '', 
            'tooltip_condition' => $request->attributescondition ? htmlspecialchars($request->conditiontooltip) : '', 
            'tooltip_watchtype' => $request->attributestype ? htmlspecialchars($request->typetooltip) : '', 
            'tooltip_case_material' => $request->attributescasematerial ? htmlspecialchars($request->casematerialtooltip) : '', 
            'tooltip_case_size' => $request->attributescasesize ? htmlspecialchars($request->casesizetooltip) : '', 
            'tooltip_screen_size' => $request->attributesscreensize ? htmlspecialchars($request->screensizetooltip) : '', 
            'tooltip_processor' => $request->attributesprocessor ? htmlspecialchars($request->processortooltip) : '', 
            'tooltip_ram' => $request->attributesram ? htmlspecialchars($request->ramtooltip) : '', 

            'storage_title' => $request->attributesstorage ? $request->storagetitle : '', 
            'network_title' => $request->attributesnetwork ? $request->networktitle : '', 
            'condition_title' => $request->attributescondition ? $request->conditiontitle : '', 
            'case_size_title' => $request->attributescasesize ? $request->casesizetitle : '', 
            'type_title' => $request->attributestype ? $request->typetitle : '', 
            'case_material_title' => $request->attributescasematerial ? $request->casematerialtitle : '', 
            'processor_title' => $request->attributesprocessor ? $request->processortitle : '', 
            'ram_title' => $request->attributesram ? $request->ramtitle : '', 
            'screen_size_title' => $request->attributesscreensize ? $request->screensizetitle : '', 
            
            // 'screen_resolution_title' => !empty($request->screenresolutiontitle) ? $request->screenresolutiontitle : '', 
            // 'connectivity_title' => !empty($request->connectivitytitle) ? $request->connectivitytitle : '', 
            // 'lyear_title' => !empty($request->lyeartitle) ? $request->lyeartitle : '', 
            // 'accessories_title' => !empty($request->accessoriestitle) ? $request->accessoriestitle : '', 
            // 'color_title' => !empty($request->colortitle) ? $request->colortitle : '', 
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }
}
