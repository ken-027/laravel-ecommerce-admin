<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Email as ModelEmail;

class Email extends Controller
{
    public function index() {
        return view('admin.content.email', [
            'order_id_list' => ModelEmail::get_orderid_list(),
            'table_name' => encrypt(ModelEmail::$table_name)
        ]);
    }


    public function get_list(Request $request) {
        $emails = ModelEmail::get_list($request);
        $total_list = ModelEmail::get_total_list($request);

        $data = array();
        foreach ($emails as $key => $email) {
            $data[$key] = [
                encrypt($email->id),
                $email->char_order_id,
                $email->from_email,
                $email->to_email,
                $email->subject,
                $email->sms_phone,
                $email->visitor_ip,
                $email->leadsource,
                date_format(date_create($email->date), 'M/d/Y h:i a'),
                encrypt($email->order_id)
                // (bool)$email->status, 
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($emails), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function view_email(Request $request) {
        $request->validate(['id' => 'required']);
        $email = ModelEmail::get_info_by_id(decrypt($request->id));
        ModelEmail::update_read(decrypt($request->id));
        $unread_messages = count(unread_messages());

        return response()->json([
            'response' => view('admin.layout.forms.email.email-message', [
                'id' => $request->id,
                'details' => $email,
            ])->render(),
            'unreadmessages' => $unread_messages,
        ]);
    }

    public function view_sms(Request $request) {
        $request->validate(['id' => 'required']);
        $email = ModelEmail::get_info_by_id(decrypt($request->id));
        ModelEmail::update_read(decrypt($request->id));
        $unread_messages = count(unread_messages());

        return response()->json([
            'response' => view('admin.layout.forms.email.sms-message', [
                'id' => $request->id,
                'details' => $email,
            ])->render(),
            'unreadmessages' => $unread_messages,
        ]);
    }

    public function view_detail(Request $request) {
        $request->validate(['id' => 'required']);
        $email = ModelEmail::get_info_by_id(decrypt($request->id));
        ModelEmail::update_read(decrypt($request->id));
        $unread_messages = count(unread_messages());

        return response()->json([
            'response' => view('admin.layout.forms.email.details', [
                'id' => $request->id,
                'details' => $email,
            ])->render(),
            'unreadmessages' => $unread_messages,
        ]);
    }
}
