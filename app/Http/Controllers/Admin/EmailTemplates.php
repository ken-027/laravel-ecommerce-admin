<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\EmailTemplate as ModelEmailTemplate;

class EmailTemplates extends Controller
{
    //
    public function index() {
        return view('admin.content.email-templates', [
            'email_types' => ModelEmailTemplate::get_type_list(),
            'table_name' => ModelEmailTemplate::$table_name
        ]);
    }


    public function get_list(Request $request) {
        $email_templates = ModelEmailTemplate::get_list($request);
        $total_list = ModelEmailTemplate::get_total_list($request);

        $data = array();
        foreach ($email_templates as $key => $email_template) {
            $data[$key] = [
                encrypt($email_template->id),
                ucwords(str_replace("_"," ", $email_template->type)),
                $email_template->subject,
                (bool)$email_template->status, 
                $key + 1 + intval($request->input('start')),
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($email_templates), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function update_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelEmailTemplate::update_status(decrypt($request->id)) 
        ]);
    }


    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-emailtemplateeditform');

        return response()->json([
            'response' => view('admin.layout.forms.email-template', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'email_template' => $is_edit ? ModelEmailTemplate::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-emailtemplateupdate');

        $request->validate([
            'subject' => 'required',
            // 'description' => 'required',
            'smssection' => 'required',
            'smscontent' => 'required',
            'publish' => 'required',
            'emailcontent' => 'required',
            // 'icon' => 'nullable|image',
        ], ['required' => 'This field is required.']);
        
        if($is_edit) $request->validate(['id' => 'required']);
        else $request->validate(['templatetype' => 'required']);

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        if(!$is_edit) {
            $result = ModelEmailTemplate::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelEmailTemplate::edit($request);
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
