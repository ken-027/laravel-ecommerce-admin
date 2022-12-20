<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Models;
use PDF;

class ImportData extends Controller
{
    public function orders(Request $request) {
        $request->validate(['csvfile' => 'required|mimes:csv'], [
            'required' => 'this field is required',
            'mimes' => 'this field must be a csv file'
        ]);

        if ($request->file('csvfile')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('csvfile')->getClientOriginalExtension();
            $path = 'orders/csv/';
            $request->file('csvfile')->storeAs( $path, $fileName, 'public');
        }
        
        $file = public_path("storage/{$path}{$fileName}");

        $get_data = csv_to_object($file);

        foreach($get_data as $model) {
            try {
                $object = new \stdClass();
                $column = [
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

                if (!array_keys_checker($model, $column)) throw new \Exception("Columns did not matched! Please do not modified Columns", 1);
                                
                $object->id = $model['Model ID'];
                $object->price = $model['Price'];
                Models\Models::update_from_import($object);
            } catch (\Throwable $th) {
                if ($th->getMessage() != 'The payload is invalid.')
                    return response()->json([
                        'response' => [
                            'status' => false,
                            'message' => $th->getMessage(),
                            'data' => $get_data,
                        ]
                ], 200);      
            }

        }

        return response()->json([
            'response' => [
                'status' => true,
                'message' => 'successfully imported',
                'data' => $get_data,
            ]
        ], 200);
        
    }

    public function models(Request $request) {
        $request->validate(['csvfile' => 'required|mimes:csv'], [
            'required' => 'this field is required',
            'mimes' => 'this field must be a csv file'
        ]);

        if ($request->file('csvfile')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('csvfile')->getClientOriginalExtension();
            $path = 'models/csv/';
            $request->file('csvfile')->storeAs( $path, $fileName, 'public');
        }
        
        $file = public_path("storage/{$path}{$fileName}");

        $get_data = csv_to_object($file);

        foreach($get_data as $model) {
            try {
                $object = new \stdClass();
                $column = [
                    'Model ID', 
                    'Brand', 
                    'Title', 
                    'Device', 
                    'Price', 
                ]; 

                if (!array_keys_checker($model, $column)) throw new \Exception("Columns did not matched! Please do not modified Columns", 1);

                $model_info = Models\Models::get_info_by_id($model['Model ID']);

                $object->id = $model['Model ID'];
                $object->title = $model['Title'];
                $object->price = $model['Price'];
                $object->brand = $model['Brand'];
                $object->order = $model['Order'];
                $object->order = $model['Order'];

                Models\Models::update_from_import($object);
                Models\Brand::update_title_by_model($object);
                Models\Device::update_title_by_model($object);

            } catch (\Throwable $th) {

                if ($th->getMessage() != 'The payload is invalid.')
                    return response()->json([
                        'response' => [
                            'status' => false,
                            'message' => $th->getMessage(),
                            'data' => $get_data,
                        ]
                    ], 200);      
            }

        }

        return response()->json([
            'response' => [
                'status' => true,
                'message' => 'successfully imported',
                'data' => $get_data,
            ]
        ], 200);
    }

    public function model_pricelist(Request $request) {
        $request->validate(['csvfile' => 'required|mimes:csv'], [
            'required' => 'this field is required',
            'mimes' => 'this field must be a csv file'
        ]);

        if ($request->file('csvfile')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('csvfile')->getClientOriginalExtension();
            $path = 'models/csv/';
            $request->file('csvfile')->storeAs( $path, $fileName, 'public');
        }
        
        $file = public_path("storage/{$path}{$fileName}");

        $get_data = csv_to_object($file);

        foreach($get_data as $model) {
            try {
                $object = new \stdClass();
                $column = [
                    'Model ID', 
                    'Brand', 
                    'Title', 
                    'Device', 
                    'Price', 
                ]; 

                if (!array_keys_checker($model, $column)) throw new \Exception("Columns did not matched! Please do not modified Columns", 1);
                                
                $object->id = $model['Model ID'];
                $object->price = $model['Price'];
                Models\Models::update_from_import($object);
                
            } catch (\Throwable $th) {

                if ($th->getMessage() != 'The payload is invalid.')
                    return response()->json([
                        'response' => [
                            'status' => false,
                            'message' => $th->getMessage(),
                            'data' => $get_data,
                        ]
                    ], 200);      
            }

        }

        return response()->json([
            'response' => [
                'status' => true,
                'message' => 'successfully imported',
                'data' => $get_data,
            ]
        ], 200);
    }
}
