<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Menu As ModelMenu;
use App\Models\Admin\Page As ModelPage;


class Menus extends Controller
{
    //
    public function index() {

        $data = [
           'menu_position' => ModelMenu::get_position_list(),
           'table_name' => encrypt(ModelMenu::$table_name)
        ];
        return view('admin.content.menus', $data);
    }

    public function get_list(Request $request) {
        // $response = [
        //     'status' => 1,
        //     'data' => view('admin.layout.tables.menu', ['menus' => ModelMenu::get_list($request)])->render(),
        // ];
        $menus = ModelMenu::get_list($request);
        $total_list = ModelMenu::get_total_list($request);
        $data = array();
        foreach ($menus as $key => $menu) {
            $data[$key] = [
                encrypt($menu->id),
                $menu->page_title,
                $menu->menu_name,
                $menu->parent,
                $menu->ordering,
                (bool)$menu->status,
                $key + 1 + intval($request->input('start')),
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($menus),
            'recordsFiltered' => count($total_list),
        ]);
    }

    public function update_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelMenu::update_status(decrypt($request->id)) 
        ]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-menuseditform');

        return response()->json([
            'response' => view('admin.layout.forms.menu', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'pages' => ModelPage::get_all(),
                'menu' => $is_edit ? ModelMenu::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-menuupdate');

        $request->validate([
            'page' => 'required',
            'name' => 'required',
            'cssclass' => 'required',
            'cssclassicon' => 'required',
            // 'parentmenu' => 'required',
            'order' => 'required',
            'status' => 'required',
            // 'description' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($is_edit) 
            $request->validate(['id' => 'required']);
        else 
            $request->validate(['url' => 'required']);

        $request->iscustomurl = !empty($request->iscustomurl) ? '1':'0';
        $request->opennewwindow = !empty($request->opennewwindow) ? '1':'0';


        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        $request->page = decrypt($request->page);

        if(!$is_edit) {
            $result = ModelMenu::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelMenu::edit($request);
            $pre_msg = 'Update';
        }
    

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }
}
