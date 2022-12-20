<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category As ModelCategory;
use App\Models\Admin\CategoriesAttribute As ModelCategoriesAttribute;
// use DB;
// use SoulDoit\DataTable\SSP;
class Categories extends Controller
{
    //
    public function index() {
        return view('admin.content.categories', [
            'table_name' => encrypt(ModelCategory::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $categories = ModelCategory::get_list($request);
        $total_list = ModelCategory::get_total_list($request);
        $data = array();
        foreach ($categories as $key => $category) {
            $data[$key] = [
                encrypt($category->id),
                asset('/storage/categories/'. base64_encode($category->id) . '/' . $category->image),
                $category->title,
                $category->fields_type,
                $category->ordering,
                (bool)$category->published,
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($categories),
            'recordsFiltered' => count($total_list),

        ]);
    }

    public function publish(Request $request) {
        $res = ModelCategory::update_publish($request->id);
        return response()->json(['update' => (bool)$res]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-categoryeditform');

        $category_attributes = [
            'networks' => $is_edit ? ModelCategoriesAttribute::get_network_list(decrypt($request->id)) : [],
            'storages' => $is_edit ? ModelCategoriesAttribute::get_storage_list(decrypt($request->id)) : [],
            'screen_sizes' => $is_edit ? ModelCategoriesAttribute::get_screen_size_list(decrypt($request->id)) : [],
            'case_sizes' => $is_edit ? ModelCategoriesAttribute::get_case_size_list(decrypt($request->id)) : [],
            'types' => $is_edit ? ModelCategoriesAttribute::get_type_list(decrypt($request->id)) : [],
            'case_materials' => $is_edit ? ModelCategoriesAttribute::get_case_material_list(decrypt($request->id)) : [],
            'conditions' => $is_edit ? ModelCategoriesAttribute::get_condition_list(decrypt($request->id)) : [],
            'processors' => $is_edit ? ModelCategoriesAttribute::get_processor_list(decrypt($request->id)) : [],
            'rams' => $is_edit ? ModelCategoriesAttribute::get_ram_list(decrypt($request->id)) : [],
        ];

        return response()->json([
            'response' => view('admin.layout.forms.category', [
                'is_edit' => $is_edit,
                'category_only' => true,
                'id' => $is_edit ? $request->id : 0,
                'category' => $is_edit ? ModelCategory::get_info_by_id(decrypt($request->id)) : [],
                'category_attributes' => (object)$category_attributes
            ])->render()
        ]);
    }


    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-categoryupdate');

        $request->validate([
            'categorytitle' => 'required',
            // 'searchablewords' => 'required',
            'publish' => 'required',
        ], ['required' => 'This field is required.']);

        $request->attributesnetwork = !empty($request->attributesnetwork) ? '1':'0';
        $request->attributesstorage = !empty($request->attributesstorage) ? '1':'0';
        $request->attributesscreensize = !empty($request->attributesscreensize) ? '1':'0';
        $request->attributescasesize = !empty($request->attributescasesize) ? '1':'0';
        $request->attributestype = !empty($request->attributestype) ? '1':'0';
        $request->attributescasematerial = !empty($request->attributescasematerial) ? '1':'0';
        $request->attributescondition = !empty($request->attributescondition) ? '1':'0';
        $request->attributesprocessor = !empty($request->attributesprocessor) ? '1':'0';
        $request->attributesram = !empty($request->attributesram) ? '1':'0';
        
        if($request->file('icon')) $request->validate(['icon' => 'image']);
        if($is_edit) $request->validate(['id' => 'required']);

        if ($request->attributesnetwork) 
            $request->validate(['networktitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributesstorage) 
            $request->validate(['storagetitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributesscreensize) 
            $request->validate(['screensizetitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributescasesize) 
            $request->validate(['casesizetitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributestype) 
            $request->validate(['typetitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributescasematerial) 
            $request->validate(['casematerialtitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributescondition) 
            $request->validate(['conditiontitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributesprocessor) 
            $request->validate(['processortitle' => 'required'], ['required' => 'This field is required.']);
        if ($request->attributesram) 
            $request->validate(['ramtitle' => 'required'], ['required' => 'This field is required.']);


        if (!empty($request->file('icon'))) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('icon')->getClientOriginalExtension();
            $request->icon = $fileName;
        }
        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        if(!$is_edit) {
            $result = ModelCategory::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelCategory::edit($request);
            $pre_msg = 'Update';
            $result = true;
        }

        $request->id = !$is_edit ? $result : $request->id;
        if ($result) {
            if ($request->attributesnetwork) 
                $this->save_network($request);
            if ($request->attributesstorage) 
                $this->save_storage($request);
            if ($request->attributesscreensize) 
                $this->save_screen_size($request);
            if ($request->attributescasesize) 
                $this->save_case_size($request);
            if ($request->attributestype) 
                $this->save_type($request);
            if ($request->attributescasematerial) 
                $this->save_case_material($request);
            if ($request->attributescondition) 
                $this->save_condition($request);
            if ($request->attributesprocessor) 
                $this->save_processor($request);
            if ($request->attributesram) 
                $this->save_ram($request);
        }
    

        if($result && !empty($request->file('icon'))) {
            $path = 'categories/' . base64_encode($request->id) . '/';
            $request->file('icon')->storeAs( $path, $fileName, 'public');
        }

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }

    private function save_network($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');

        $existing_data = $is_edit ? ModelCategoriesAttribute::get_network_list($request->id) : [];
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('networks', $request->id);

        $exist = false;
        foreach ($request->networkname as $key => $network) {
            $networks = new \stdClass();
            $networks->name = $network;
            $networks->id = $request->id;
            $networks->icon = '';

            if (!empty($request->networkslogo[$key]) && $request->networkslogo[$key]->getClientOriginalName() != 'sample123.test') {
                $fileName = base64_encode(date('YmdGis'));
                $fileName .= '.' . $request->networkslogo[$key]->getClientOriginalExtension();
                $networks->icon = $fileName;
                $exist = false;
            } else {
                foreach ($existing_data as $data) {
                    $exist = true;
                    if ($data->id == decrypt($request->networkid[$key])) {
                        $networks->icon = $data->network_icon;
                    }
                }
            }
 
            $result = ModelCategoriesAttribute::insert_network($networks); 

            if(!empty($request->networkslogo[$key]) && $request->networkslogo[$key]->getClientOriginalName() != 'sample123.test') {
                $path = 'categories/' . base64_encode( $request->id) . '/networks/';
                $request->networkslogo[$key]->storeAs( $path, $fileName, 'public');
            }
    
        }
    }


    private function save_storage($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');

        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('storage', $request->id);
        foreach ($request->storagesize as $key => $storagesize) {
            $storage = new \stdClass();
            $storage->id = $request->id;
            $storage->size = $storagesize;
            $storage->unit = $request->storageunit[$key];
            $storage->status = $request->storagestatus[$key];
        
            $result = ModelCategoriesAttribute::insert_storage($storage); 
        }
    }

    private function save_screen_size($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('screen_size', $request->id);
        foreach ($request->screensizename as $key => $screensizename) {
            $screensize = new \stdClass();
            // $network_result[$key] = $network;  
            $screensize->id = $request->id;
            $screensize->size = $screensizename;
            $result = ModelCategoriesAttribute::insert_screen_size($screensize); 
        }
    }

    private function save_case_size($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('case_size', $request->id);
        foreach ($request->casesize as $key => $casesize) {
            $casesizeobj = new \stdClass();
            // $network_result[$key] = $network;  
            $casesizeobj->id = $request->id;
            $casesizeobj->size = $casesize;
            $result = ModelCategoriesAttribute::insert_case_size($casesizeobj); 
        }
    }

    private function save_type($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('watchtype', $request->id);
        foreach ($request->typename as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $obj->status = $request->typestatus[$key];
            $result = ModelCategoriesAttribute::insert_type($obj); 
        }
    }

    private function save_case_material($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('case_material', $request->id);
        foreach ($request->casematerial as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $result = ModelCategoriesAttribute::insert_case_material($obj); 
        }
    }

    private function save_condition($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('condition', $request->id);
        foreach ($request->conditionname as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $obj->term = $request->conditionterms[$key];
            $result = ModelCategoriesAttribute::insert_condition($obj); 
        }
    }

    private function save_processor($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('processor', $request->id);
        foreach ($request->processorname as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $result = ModelCategoriesAttribute::insert_processor($obj); 
        }
    }

    private function save_ram($request) {
        $is_edit = (bool)request()->routeIs('admin-categoryupdate');
        
        if ($is_edit) ModelCategoriesAttribute::delete_existing_attributes('ram', $request->id);
        foreach ($request->ramsize as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->size = $value;
            $obj->unit = $request->ramunit[$key];
            $result = ModelCategoriesAttribute::insert_ram($obj); 
        }
    }
}
