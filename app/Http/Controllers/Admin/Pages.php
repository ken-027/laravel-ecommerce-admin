<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page As ModelPage;
use App\Models\Admin\Category As ModelCategory;
use App\Models\Admin\Device As ModelDevice;
use DB;

class Pages extends Controller
{
    //
    public function index() {
        return view('admin.content.pages',[
            'table_name' => encrypt(ModelPage::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        // $response = [
        //     'status' => 1,
        //     'data' => view('admin.layout.tables.page', ['pages' => ModelPage::get_list($request)])->render(),
        // ];
        $pages = ModelPage::get_list($request);
        $total_list = ModelPage::get_total_list($request);
        $data = array();
        foreach ($pages as $key => $page) {
            $data[$key] = [
                encrypt($page->id),
                $page->title,
                $page->url,
                $page->meta_title,
                $page->meta_desc,
                $page->meta_keywords,
                (bool)$page->published,
                $key + 1 + intval($request->input('start')),
            ];
        }
        return response()->json([
            // 'draw' => $request->draw,
            'recordsTotal' => count($pages),
            'recordsFiltered' => count($total_list),
            'data' => $data,
        ]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-pageseditform');
        return response()->json([
            'response' => view('admin.layout.forms.page', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'categories' => ModelCategory::get_all(),
                'devices' => ModelDevice::get_all(),
                'page' => $is_edit ? ModelPage::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-pageupdate');

        $request->validate([
            'category' => 'required',
            'device' => 'required',
            'title' => 'required',
            'url' => 'required',
            'cssclass' => 'required',
            'moduleposition' => 'required',
            'imagetext' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeywords' => 'required',
            // 'description' => 'required',
            'publish' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($request->file('headerimage')) $request->validate(['headerimage' => 'image']);
        if($is_edit) $request->validate(['id' => 'required']);

        $request->showtitle = !empty($request->showtitle) ? '1':'0';
        $request->iscustomurl = !empty($request->iscustomurl) ? '1':'0';
        $request->opennewwindow = !empty($request->opennewwindow) ? '1':'0';

        if ($request->file('headerimage')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('headerimage')->getClientOriginalExtension();
            $request->headerimage = $fileName;
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

        if(!$is_edit) {
            $result = ModelPage::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelPage::edit($request);
            $pre_msg = 'Update';
        }
    

        if($result && $request->file()) {
            $id = !$is_edit ? $result : $request->id;
            $path = 'pages/' . base64_encode($id) . '/';
            $request->file('headerimage')->storeAs( $path, $fileName, 'public');
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
