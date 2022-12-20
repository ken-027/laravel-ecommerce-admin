<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Models;
use PDF;

class ExportData extends Controller
{
    public function csv($file_name, $columns = [], callable $preparation) {
        $file_name .= date('YmdGis') . '.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$file_name",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use ($columns, $preparation) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $preparation($file);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 

    public function pdf($data, $view) {

    }

    public function orders(Request $request) {
        if ($request->routeIs('awaiting-orders-export')) {
            $orders = Models\Order::get_awaiting_list($request, false);
            $title = 'Awaiting Orders';
            $filename = 'awaiting-order';
        }
        elseif ($request->routeIs('unpaid-orders-export')) {
            $orders = Models\Order::get_unpaid_list($request, false);
            $title = 'Unpaid Orders';
            $filename = 'unpaid-order';
        }
        elseif ($request->routeIs('paid-orders-export')) {
            $orders = Models\Order::get_paid_list($request, false);
            $title = 'Paid Orders';
            $filename = 'paid-order';
        }
        else {
            $orders = Models\Order::get_archive_list($request, false);
            $title = 'Archive Orders';
            $filename = 'archive-order';
        }

        if ($request->type == 'pdf') {
            $filename .= date('YmdGis').'.pdf';
            $pdf = PDF::loadView('pdf/orders', [
                'orders' => $orders,
                'title' => $title,
                'datefrom' => format_date($request->datefrom),
                'dateto' => format_date($request->dateto),
            ]);
            return $pdf->download($filename);
            
        } elseif ($request->type == 'csv') {   
            $columns = [
                'Order ID', 
                'Customer', 
                'Date', 
                'Appproved Date', 
                'Price', 
                'Payment', 
                'Status', 
                'Paypal Address', 
                'BSB',
                'Account Number',
                'Account Holder Name',
                'Bitcoin Number'
            ];
            
            $preparation = function($file) use ($orders) {
                foreach ($orders as $order) {
                    $data = [
                        !empty($order->order_id) ? $order->order_id : '',
                        "$order->first_name $order->last_name",
                        !empty($order->date) ? $order->date : '',
                        !empty($order->approved_date) ? $order->approved_date : '',
                        !empty($order->total_orders) ? amount_format($order->total_orders) : '',
                        !empty($order->type) ? $order->type : '',
                        !empty($order->status) ? $order->status : '',
                        !empty($order->paypal_address) ? $order->paypal_address : '',
                        !empty($order->act_short_code) ? $order->act_short_code : '',
                        !empty($order->act_number) ? $order->act_number : '',
                        !empty($order->act_name) ? $order->act_name : '',
                        !empty($order->bitcoin_number) ? $order->bitcoin_number : '',
                    ];

                    fputcsv($file, $data);
                }
            };

            return $this->csv($filename, $columns, $preparation);
        }
    }

    public function models(Request $request) {
        $models = Models\Models::get_list($request, false);
        
        if ($request->type == 'pdf') {
            $filename = 'models'.date('YmdGis').'.pdf';
            $pdf = PDF::loadView('pdf/models', [
                'models' => $models,
                'title' => 'Models',
                'category' => $request->category,
                'brand' => $request->brand,
                'device' => $request->device,
            ]);
            return $pdf->download($filename);
        } elseif ($request->type == 'csv') {
            $columns = [
                'Model ID', 
                'Brand', 
                'Title', 
                'Device', 
                'Order', 
                'Price', 
                // 'Field Title', 
                // 'Field Item ID', 
                // 'Field Item Title', 
                // 'Field Item Price',
            ];

            $preparation = function($file) use ($models) {
                foreach ($models as $model) {
                    $data = [
                        !empty($model->id) ? $model->id : '',
                        !empty($model->brand) ? $model->brand : '',
                        !empty($model->title) ? $model->title : '',
                        !empty($model->device) ? $model->device : '',
                        !empty($model->ordering) ? $model->ordering : 0,
                        !empty($model->price) ? amount_format($model->price) : 0,
                        // !empty($model->price) ? $model->price : '',
                        // !empty($model->price) ? $model->price : '',
                        // !empty($model->price) ? $model->price : '',
                    ];

                    fputcsv($file, $data);
                }
            };

            return $this->csv('models', $columns, $preparation);
        }
    }

    public function model_pricelist(Request $request) {
        $models_pricelist = Models\ModelsAttribute::get_pricing_list(decrypt($request->id));
        $model_info = Models\Models::get_info_by_id(decrypt($request->id));
        $filename = 'models-pricelist';

        if ($request->type == 'pdf') {
            $filename .= date('YmdGis').'.pdf';
            $pdf = PDF::loadView('pdf/models-pricelist', [
                'models_pricelist' => $models_pricelist,
                'model_info' => $model_info,
            ]);
            return $pdf->download($filename);
        } elseif ($request->type == 'csv') {
            $columns = [
                'Price ID', 
                'Title', 
                'Specs', 
            ];

            $prices = [];
            foreach($models_pricelist as $model) {
                $prices = json_decode($model->price);
                foreach($prices as $key => $value) {
                    array_push($columns, $key);
                }
                break;
            }

            $preparation = function($file) use ($models_pricelist) {
                foreach ($models_pricelist as $key => $model) {
                    $prices = json_decode($model->price);

                    $data = [
                        !empty($model->id) ? $model->id : '',
                        !empty($model->title) ? $model->title : '',
                        !empty($model->name) ? $model->name : '',
                    ];

                    foreach($prices as $key => $price) {
                        array_push($data, amount_format($price));
                    }
                    fputcsv($file, $data);
                }
            };

            return $this->csv($filename, $columns, $preparation);
        }
    }
}
