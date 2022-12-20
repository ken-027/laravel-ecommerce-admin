<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contact as ModelContact;
use App\Models\Admin\Review as ModelReview;
use App\Models\Admin\BulkOrderForm as ModelBulkOrder;
use App\Models\Admin\Newsletter as ModelNewsletter;

class Forms extends Controller
{
    //

    public function contacts() {
        
        return view('admin.content.forms.contacts', [
            'table_name' => encrypt(ModelContact::$table_name)
        ]);
    }

    public function reviews() {
        return view('admin.content.forms.reviews', [
            'table_name' => encrypt(ModelReview::$table_name)
        ]);
    }

    public function bulk_orders() {
        return view('admin.content.forms.bulk-orders', [
            'table_name' => encrypt(ModelBulkOrder::$table_name)
        ]);
    }

    public function newsletter() {
        return view('admin.content.forms.newsletter', [
            'table_name' => encrypt(ModelNewsletter::$table_name)
        ]);
    }

    public function get_contact_list(Request $request) {
        $contacts = ModelContact::get_list($request);
        $total_list = ModelReview::get_total_list($request);

        $data = array();
        foreach ($contacts as $key => $contact) {
            $data[$key] = [
                encrypt($contact->id),
                $contact->name,
                $contact->email,
                $contact->subject,
                $contact->message,
                $contact->type,
                date_format(date_create($contact->date), 'M/d/Y h:i a'),
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($contacts), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }


    public function get_review_list(Request $request) {
        $reviews = ModelReview::get_list($request);
        $total_list = ModelReview::get_total_list($request);

        $data = array();
        foreach ($reviews as $key => $review) {
            $data[$key] = [
                encrypt($review->id),
                $review->name,
                $review->email,
                $review->city,
                $review->state,
                $review->zip_code,
                $review->stars,
                date_format(date_create($review->date), 'M/d/Y h:i a'),
                (bool)$review->status,
                (bool)$review->published,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($reviews), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function get_bulkorder_list(Request $request) {
        $bulk_orders = ModelBulkOrder::get_list($request);
        $total_list = ModelBulkOrder::get_total_list($request);

        $data = array();
        foreach ($bulk_orders as $key => $bulk_order) {
            $data[$key] = [
                encrypt($bulk_order->id),
                $bulk_order->name,
                $bulk_order->email,
                $bulk_order->phone,
                $bulk_order->company_name,
                $bulk_order->content,
                date_format(date_create($bulk_order->date), 'M/d/Y h:i a'),
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($bulk_orders), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function get_newsletter_list(Request $request) {
        $newsletters = ModelNewsletter::get_list($request);
        $total_list = ModelNewsletter::get_total_list($request);

        $data = array();
        foreach ($newsletters as $key => $newsletter) {
            $data[$key] = [
                encrypt($newsletter->id),
                $newsletter->email,
                date_format(date_create($newsletter->date), 'M/d/Y h:i a'),
                (bool)$newsletter->status,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($newsletters), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function review_form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-reviewseditform');
        return response()->json([
            'response' => view('admin.layout.forms.review', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'review' => $is_edit ? ModelReview::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save_review(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'reviewwebsite' => 'required',
            'starrating' => 'required',
            'date' => 'required|date',
            'publish' => 'required',
            // 'icon' => 'nullable|image',
        ], [ 'required' => 'This field is required.' ]);

        if(!request()->routeIs('admin-reviewadd')) $request->validate(['id' => 'required']);


        if(request()->routeIs('admin-reviewadd')) {
            $result = ModelReview::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelReview::edit($request);
            $pre_msg = 'Update';
        }
    

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
                'icon' => $request->file('icon')
            ]
        ]);
    }
    
    public function update_newsletter_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelNewsletter::update_status(decrypt($request->id)) 
        ]);
    }

    public function update_review_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelReview::update_status(decrypt($request->id)) 
        ]);
    }
}
