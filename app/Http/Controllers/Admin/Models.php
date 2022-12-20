<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Models As ModelModels;
use App\Models\Admin\ModelsAttribute As ModelsAttribute;
use App\Models\Admin\CategoriesAttribute As ModelCategoriesAttribute;
use App\Models\Admin\Category As ModelCategory;
use App\Models\Admin\Device As ModelDevice;
use App\Models\Admin\Brand As ModelBrand;

class Models extends Controller
{
    public function index() {
        $filter = [
            'categories' => ModelCategory::get_all(),
            'devices' => ModelDevice::get_all(),
            'brand' => ModelBrand::get_all(),
            'table_name' => encrypt(ModelModels::$table_name),
        ];
        return view('admin.content.models', $filter);
    }

    public function get_list(Request $request) {

        $models = ModelModels::get_list($request);
        $total_list = ModelModels::get_total_list($request);

        $data = array();
        foreach ($models as $key => $model) {
            $data[$key] = [
                encrypt($model->id),
                // asset('/assets/images/mobile/'. $model->model_img),
                asset('storage/models/' . base64_encode($model->id) . '/' . $model->model_img),
                $model->title,
                $model->device,
                $model->brand,
                $model->ordering,
                (bool)$model->published
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($models),
            'recordsFiltered' => count($total_list),
        ]);
    }

    public function publish(Request $request) {
        
        $res = ModelModels::update_publish($request->id);
        return response()->json(['update' => (bool)$res]);
    }

    public function get_top_model_by_orders() {
        $brand_list = ModelModels::get_list_by_ordering();
        $data = array();
        foreach ($brand_list as $key => $brand) {
            $data[$key] = [
                encrypt($brand->id),
                $brand->title,
                $brand->ordering,
                (bool)$brand->published
            ];
        }
        $data = array_slice((array)$data, 0, 10);
        array_multisort( array_column($data, 1), SORT_ASC, $data );

        return response()->json(['data' => $data]);
    }

    public function get_attributes_form_by_category(Request $request) {
        $id = decrypt($request->id);
        $response = '';
        $show_menu = [];
        $category = ModelCategory::get_info_by_id($id);

        if (!empty($category->network_title)) {
            $show_menu[] = 'networkMenu';
            
            $category_attributes = [
                'networks' =>  ModelCategoriesAttribute::get_network_list($id),
            ];

            $response .= view('admin.layout.forms.category.network', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->storage_title)) {
            $show_menu[] = 'storageMenu';

            $category_attributes = [
                'storages' =>  ModelCategoriesAttribute::get_storage_list($id),
            ];

            $response .= view('admin.layout.forms.category.storage', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->screen_size_title)) {
            $show_menu[] = 'screenSizeMenu';
            
            $category_attributes = [
                'screen_sizes' =>  ModelCategoriesAttribute::get_screen_size_list($id),
            ];

            $response .= view('admin.layout.forms.category.screen-size', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->case_size_title)) {
            $show_menu[] = 'caseSizeMenu';

            $category_attributes = [
                'case_sizes' =>  ModelCategoriesAttribute::get_case_size_list($id),
            ];

            $response .= view('admin.layout.forms.category.case-size', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->type_title)) {
            $show_menu[] = 'typeMenu';

            $category_attributes = [
                'types' =>  ModelCategoriesAttribute::get_type_list($id),
            ];

            $response .= view('admin.layout.forms.category.type', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->case_material_title)) {
            $show_menu[] = 'caseMaterialMenu';

            $category_attributes = [
                'case_materials' =>  ModelCategoriesAttribute::get_case_material_list($id),
            ];

            $response .= view('admin.layout.forms.category.case-material', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->condition_title)) {
            $show_menu[] = 'conditionMenu';
            
            $category_attributes = [
                'conditions' =>  ModelCategoriesAttribute::get_condition_list($id),
            ];

            $response .= view('admin.layout.forms.category.condition', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }
        if (!empty($category->processor_title)) {
            $show_menu[] = 'processorMenu';

            $category_attributes = [
                'processors' =>  ModelCategoriesAttribute::get_processor_list($id),
            ];

            $response .= view('admin.layout.forms.category.processor', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        if (!empty($category->ram_title)) {
            $show_menu[] = 'ramMenu';
            
            $category_attributes = [
                'rams' =>  ModelCategoriesAttribute::get_ram_list($id),
            ];

            $response .= view('admin.layout.forms.category.ram', [
                'is_edit' => false,
                'category_attributes' => (object)$category_attributes
            ])->render();
        }

        return response()->json([
            'response' => [
                'html' => $response,
                'menu' => $show_menu,
            ]
        ]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-modelseditform');

        $model_attributes = [
            'networks' => $is_edit ? ModelsAttribute::get_network_list(decrypt($request->id)) : [],
            'storages' => $is_edit ? ModelsAttribute::get_storage_list(decrypt($request->id)) : [],
            'screen_sizes' => $is_edit ? ModelsAttribute::get_screen_size_list(decrypt($request->id)) : [],
            'case_sizes' => $is_edit ? ModelsAttribute::get_case_size_list(decrypt($request->id)) : [],
            'types' => $is_edit ? ModelsAttribute::get_type_list(decrypt($request->id)) : [],
            'case_materials' => $is_edit ? ModelsAttribute::get_case_material_list(decrypt($request->id)) : [],
            'conditions' => $is_edit ? ModelsAttribute::get_condition_list(decrypt($request->id)) : [],
            'processors' => $is_edit ? ModelsAttribute::get_processor_list(decrypt($request->id)) : [],
            'rams' => $is_edit ? ModelsAttribute::get_ram_list(decrypt($request->id)) : [],
        ];
//         echo var_dump(!count($model_attributes['networks']));
// exit(var_dump($model_attributes));
        return response()->json([
            'response' => view('admin.layout.forms.models', [
                'categories' => ModelCategory::get_all(),
                'devices' => ModelDevice::get_all(),
                'brand' => ModelBrand::get_all(),
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'mobile' => $is_edit ? ModelModels::get_info_by_id(decrypt($request->id)) : [],
                // 'networks' => $is_edit ? ModelsAttribute::get_network_list(decrypt($request->id)) : [],
                // 'storage_list' => $is_edit ? ModelsAttribute::get_storage_list(decrypt($request->id)) : [],
                // 'conditions' => $is_edit ? ModelsAttribute::get_condition_list(decrypt($request->id)) : [],
                'category_attributes' => (object)$model_attributes
            ])->render()
        ]);
    }

    public function pricing_form(Request $request) {
        $model_id = decrypt($request->id);
// exit(var_dump(ModelsAttribute::get_catalog_list($model_id)));
        return response()->json([
            'response' => view('admin.layout.forms.pricing', [
                'id' => $model_id,
                'is_edit' => true,
                'mobile' => ModelModels::get_info_by_id($model_id),
                'pricing' => ModelsAttribute::get_pricing_list($model_id),
            ])->render()
        ]);
    }

    public function update_price(Request $request) {
        $request->validate(['price']);
        $model_id = decrypt($request->id);
        $result = false;
        foreach ($request->price as $catalog_id => $price) {
            $obj = new \stdClass();
            $obj->id = decrypt($catalog_id);
            $obj->condition = json_encode($price);
            
            $temp_res = ModelsAttribute::update_pricing($obj);
            if ($temp_res) $result = true;            
        }

        $message = $result ? 'Update successfully' : "Failed to Update!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }

    public function save(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'device' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeywords' => 'required',
            'searchablewords' => 'required',
            'publish' => 'required',
        ], ['required' => 'This field is required.']);

        if($request->file('icon')) $request->validate(['icon' => 'image']);
        if($is_edit) $request->validate(['id' => 'required']);

        // $request->isdevicepopular = !empty($request->isdevicepopular) ? '1':'0';

        if ($request->file('icon')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('icon')->getClientOriginalExtension();
            $request->icon = $fileName;
            // $path = 'setting/' . base64_encode($request->id) . '/';
        // $request->logo = $path . $fileName;
        }

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();
        
        $request->category = decrypt($request->category);
        $request->device = decrypt($request->device);
        $request->brand = decrypt($request->brand);

        if(!$is_edit) {
            $result = ModelModels::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelModels::edit($request);
            $pre_msg = 'Update';
            $result = true;
        }

        $request->id = !$is_edit ? $result : $request->id;


        if ($result) {
            if ($is_edit) {
                ModelsAttribute::delete_existing_attributes('networks', $request->id);
                ModelsAttribute::delete_existing_attributes('storage', $request->id);
                ModelsAttribute::delete_existing_attributes('screen_size', $request->id);
                ModelsAttribute::delete_existing_attributes('case_size', $request->id);
                ModelsAttribute::delete_existing_attributes('watchtype', $request->id);
                ModelsAttribute::delete_existing_attributes('case_material', $request->id);
                ModelsAttribute::delete_existing_attributes('condition', $request->id);
                ModelsAttribute::delete_existing_attributes('processor', $request->id);
                ModelsAttribute::delete_existing_attributes('ram', $request->id);
                ModelsAttribute::delete_existing_attributes('catalog', $request->id);
            }
            $category = ModelCategory::get_info_by_id($request->category);

            $result_attributes = false;
            if (!empty($category->network_title)) 
                $result_attributes = $this->save_network($request);
            if (!empty($category->storage_title)) 
                $result_attributes = $this->save_storage($request);
            if (!empty($category->screen_size_title)) 
                $result_attributes = $this->save_screen_size($request);
            if (!empty($category->case_size_title)) 
                $result_attributes = $this->save_case_size($request);
            if (!empty($category->type_title)) 
                $result_attributes = $this->save_type($request);
            if (!empty($category->case_material_title)) 
                $result_attributes = $this->save_case_material($request);
            if (!empty($category->condition_title)) 
                $result_attributes = $this->save_condition($request);
            if (!empty($category->processor_title)) 
                $result_attributes = $this->save_processor($request);
            if (!empty($category->ram_title)) 
                $result_attributes = $this->save_ram($request);

            if ($result_attributes) 
                $this->save_pricing($request);
        }


        if($result && !empty($request->file('icon'))) {
            $path = 'models/' . base64_encode($request->id) . '/';
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

    private function save_pricing($request) {
        $result = false;

        if (!empty($request->networkname)) {
            foreach ($request->networkname as $network_row => $network) {
                $condition_price = [];
                foreach ($request->conditionname as $condition) {
                    $condition_price[$condition] = 0; 
                }
                foreach ($request->storagesize as $storage_row => $storage) {
                    $obj = new \stdClass();
                    $obj->id = $request->id;
                    $obj->name = $network . ' ' . $storage . $request->storageunit[$storage_row];
                    $obj->price = json_encode($condition_price);
                    $result = ModelsAttribute::insert_pricing($obj);
                }
            }
        }

        if (!empty($request->typename)) {
            foreach ($request->typename as $type) {
                $condition_price = [];
                foreach ($request->conditionname as $condition) {
                    $condition_price[$condition] = 0; 
                }
                
                foreach ($request->casematerial as $case_material) {
                    foreach ($request->casesize as $case_size_row => $case_size) {
                        $obj = new \stdClass();
                        $obj->id = $request->id;
                        $obj->name = $type . ' ' . $case_material . ' ' . $case_size;
                        $obj->price = json_encode($condition_price);
                        $result = ModelsAttribute::insert_pricing($obj);
                    }
                }
            }
        }
        // exit(var_dump($arr_object));
        return $result;
    }

    private function save_network($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        $existing_data = $is_edit ? ModelsAttribute::get_network_list($request->id) :  ModelCategoriesAttribute::get_network_list($request->category);

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
 
            $result = ModelsAttribute::insert_network($networks); 

            if(!empty($request->networkslogo[$key]) && $request->networkslogo[$key]->getClientOriginalName() != 'sample123.test') {
                $path = 'models/' . base64_encode( $request->id) . '/networks/';
                $request->networkslogo[$key]->storeAs( $path, $fileName, 'public');
            }
    
        }

        return $result;
    }

    private function save_storage($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        foreach ($request->storagesize as $key => $storagesize) {
            $storage = new \stdClass();
            $storage->id = $request->id;
            $storage->size = $storagesize;
            $storage->unit = $request->storageunit[$key];
            $storage->status = $request->storagestatus[$key];
        
            $result = ModelsAttribute::insert_storage($storage); 
        }

        return $result;
    }

    private function save_screen_size($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        
        foreach ($request->screensizename as $key => $screensizename) {
            $screensize = new \stdClass();
            // $network_result[$key] = $network;  
            $screensize->id = $request->id;
            $screensize->size = $screensizename;
            $result = ModelsAttribute::insert_screen_size($screensize); 
        }
        return $result;
    }

    private function save_case_size($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;

        foreach ($request->casesize as $key => $casesize) {
            $casesizeobj = new \stdClass();
            // $network_result[$key] = $network;  
            $casesizeobj->id = $request->id;
            $casesizeobj->size = $casesize;
            $result = ModelsAttribute::insert_case_size($casesizeobj); 
        }

        return $result;
    }

    private function save_type($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        
        foreach ($request->typename as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $obj->status = $request->typestatus[$key];
            $result = ModelsAttribute::insert_type($obj); 
        }
        return $result;
    }

    private function save_case_material($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        
        foreach ($request->casematerial as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $result = ModelsAttribute::insert_case_material($obj); 
        }
        return $result;
    }

    private function save_condition($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;

        foreach ($request->conditionname as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $obj->term = $request->conditionterms[$key];
            $result = ModelsAttribute::insert_condition($obj); 
        }
        return $result;
    }

    private function save_processor($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        
        foreach ($request->processorname as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->name = $value;
            $result = ModelsAttribute::insert_processor($obj); 
        }
        return $result;
    }

    private function save_ram($request) {
        $is_edit = (bool)request()->routeIs('admin-modelupdate');
        $result = false;
        
        foreach ($request->ramsize as $key => $value) {
            $obj = new \stdClass();
            // $network_result[$key] = $network;  
            $obj->id = $request->id;
            $obj->size = $value;
            $obj->unit = $request->ramunit[$key];
            $result = ModelsAttribute::insert_ram($obj); 
        }
        return $result;
    }
}
