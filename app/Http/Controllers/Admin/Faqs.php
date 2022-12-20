<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Faq As ModelFaq;
use App\Models\Admin\FaqGroup As ModelFaqGroup;
use App\Models\Admin\Category As ModelCategory;

class Faqs extends Controller
{
    //
    public function index() {
        return view('admin.content.faqs.index', [
            'table_name' => encrypt(ModelFaq::$table_name)
        ]);
    }

    public function group() {
        return view('admin.content.faqs.groups', [
            'table_name' => encrypt(ModelFaqGroup::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $faqs = ModelFaq::get_list($request);
        $total_list = ModelFaq::get_total_list($request);

        $data = array();
        foreach ($faqs as $key => $faq) {
            $data[$key] = [
                encrypt($faq->id),
                $faq->title,
                $faq->group_title,
                $faq->ordering,
                (bool)$faq->status,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($faqs), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function get_group_list(Request $request) {
        $faqs_groups = ModelFaqGroup::get_list($request);
        $total_list = ModelFaqGroup::get_total_list($request);

        $data = array();
        foreach ($faqs_groups as $key => $faqs_group) {
            $data[$key] = [
                encrypt($faqs_group->id),
                $faqs_group->title,
                $faqs_group->category,
                $faqs_group->ordering,
                (bool)$faqs_group->status,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($faqs_groups), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-faqeditform');

        return response()->json([
            'response' => view('admin.layout.forms.faq', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'faq_groups' => ModelFaqGroup::get_all(),
                'faq' => $is_edit ? ModelFaq::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function form_group(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-faqgroupeditform');

        return response()->json([
            'response' => view('admin.layout.forms.faq-group', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'categories' => ModelCategory::get_all(),
                'faq_group' => $is_edit ? ModelFaqGroup::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-faqupdate');

        $request->validate([
            'group' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'publish' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($is_edit) $request->validate(['id' => 'required']);


        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        $request->group = decrypt($request->group);

        if(!$is_edit) {
            $result = ModelFaq::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelFaq::edit($request);
            $pre_msg = 'Update';
        }
        
        $result = 1;

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }

    public function save_group(Request $request) {
        $is_edit = request()->routeIs('admin-faqgroupupdate');

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'publish' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($is_edit) $request->validate(['id' => 'required']);


        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        $request->category = decrypt($request->category);

        if(!$is_edit) {
            $result = ModelFaqGroup::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelFaqGroup::edit($request);
            $pre_msg = 'Update';
        }
        
        $result = 1;

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }
}
