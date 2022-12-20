<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin AS ModelAdmin;
use EasyPost\EasyPost;
use EasyPost\Shipment;

class Orders extends Controller
{
    public function awaiting() {
        $data = [
            'payment_method' => ModelAdmin\Order::get_payment_method_list(),
            'table_name' => encrypt(ModelAdmin\Order::$table_name)
        ];
        return view('admin.content.orders', $data);
    }

    public function unpaid() {
        $data = [
            'payment_method' => ModelAdmin\Order::get_payment_method_list(),
            'status' => ModelAdmin\Order::get_status_list(),
            'table_name' => encrypt(ModelAdmin\Order::$table_name)
        ];
        return view('admin.content.orders', $data);      
    }

    public function paid() {
        $data = [
            'payment_method' => ModelAdmin\Order::get_payment_method_list(),
            'status' => ModelAdmin\Order::get_status_list(),
            'table_name' => encrypt(ModelAdmin\Order::$table_name)
        ];
        return view('admin.content.orders', $data);
    }

    public function archive() {
        $data = [
            'payment_method' => ModelAdmin\Order::get_payment_method_list(),
            'status' => ModelAdmin\Order::get_status_list(),
            'table_name' => encrypt(ModelAdmin\Order::$table_name)
        ];
        return view('admin.content.orders', $data);
    }

    public function get_list(Request $request) {
        $orders = [];
        if ($request->type == 'awaiting') {
            $orders = ModelAdmin\Order::get_awaiting_list($request);
            $total_list = ModelAdmin\Order::get_total_awaiting_list($request);
        }
        elseif ($request->type == 'unpaid') {
            $orders = ModelAdmin\Order::get_unpaid_list($request);
            $total_list = ModelAdmin\Order::get_total_unpaid_list($request);
        }
        elseif ($request->type == 'paid') { 
            $orders = ModelAdmin\Order::get_paid_list($request);
            $total_list = ModelAdmin\Order::get_total_paid_list($request);
        }
        elseif ($request->type == 'archive') { 
            $orders = ModelAdmin\Order::get_archive_list($request);
            $total_list = ModelAdmin\Order::get_total_archive_list($request);
        }

        $data = array();
        foreach ($orders as $key => $order) {
            // exit(var_dump(date_create($order->date)));
            $data[$key] = [
                encrypt($order->id),
                $order->order_id,
                empty($order->user_id) ? 'unknown' : $order->name,
                date_format(date_create($order->date), 'M/d/Y h:i a'),
                date_format(date_create($order->approved_date), 'M/d/Y'),
                number_format($order->total_orders, 2),
                $order->type,
                $order->status,
                encrypt($order->user_id),
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($orders), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
        // return response()->json(['data' => $data]);
    }


    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-ordereditform');
        // $request->validate(['id', 'required']);

        $request->id = decrypt($request->id);

        $mail_template = ModelAdmin\EmailTemplate::get_template_by_type('admin_reply_from_order');
        $setting_info = ModelAdmin\GeneralSetting::get_list();
        $order_data = ModelAdmin\Order::get_info_by_id($request->id);
        $comments = ModelAdmin\Comment::get_list($order_data->order_id);

        $patterns = mail_templates(['type' => 'admin_reply_from_order'])->data;
        // return response()->json([
        //     'response' => var_dump($patterns)
        // ]);

        $replacements = [
            '/assets/images/logo.png',
            '',
            $request->session()->get('account')->email,
            $request->session()->get('account')->username,
            '/admin/dashboard',
            $setting_info->admin_panel_name,
            $setting_info->from_name,
            $setting_info->from_email,
            $request->getSchemeAndHttpHost(),
            $order_data->first_name,
            $order_data->last_name,
            $order_data->name,
            $order_data->phone,
            $order_data->email,
            $order_data->address,
            $order_data->address2,
            $order_data->city,
            $order_data->state,
            $order_data->country,
            $order_data->postcode,
            $order_data->company_name,
            $order_data->order_id,
            $order_data->payment_method,
            $order_data->order_date,
            $order_data->status_label,
            $order_data->approved_date,
            $order_data->expire_date,
            $order_data->sales_pack,
            date('Y-m-d H:i'),
        ];

        $email = [
            'subject' => str_replace($patterns, $replacements, $mail_template->subject),
            'body' => str_replace($patterns, $replacements, $mail_template->content) 
        ];

        return response()->json([
            'response' => view('admin.layout.forms.order', [
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'email' => (object)$email,
                'order_status' => ModelAdmin\OrderAttribute::get_status_type_list()->sortBy('status'),
                'order_items' => ModelAdmin\OrderAttribute::get_item_list($request->id),
                'order_info' => $is_edit ? $order_data : [],
                'comments' => $is_edit ? $comments : [],
            ])->render()
        ]);
    }        

    public function invoice_form(Request $request) {
        $setting_info = ModelAdmin\GeneralSetting::get_list();
        $order_info = ModelAdmin\Order::get_info_by_id(decrypt($request->id));

        EasyPost::setApiKey($setting_info->shipping_api_key);

        $shipment = Shipment::retrieve($order_info->shipment_id);

        return response()->json([
            'response' => view('admin.layout.forms.order.invoice-details', [
                'id' => $request->id,
                'order_info' => $order_info,
                'shipment_info' => $shipment,
            ])->render()
        ]);
    }

    public function preview_pdf(Request $request) {
        $request->validate(['id', 'required']);

        return response()->json([
            'response' => view('admin.layout.forms.preview-pdf', [
                'id' => $request->id 
            ])
        ]);
    }

    public function save_comment(Request $request) {
        $request->validate([
            'orderid' => 'required',
            'status' => 'required',
            'comment' => 'required',
        ]);

        $request->staff = decrypt($request->session()->get('account')->id);
        $result = ModelAdmin\Comment::insert($request);
        $comments = ModelAdmin\Comment::get_list($request->orderid);
        
        $message = $result ? 'Save successfully' : "Failed to Save!";

        $comment_list = view('admin.layout.forms.order.comment', [
            'comments' => $comments,
        ])->render();

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
                'comments' => $comment_list,
            ]
        ]);
    }
}
