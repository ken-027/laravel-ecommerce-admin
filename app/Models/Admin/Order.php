<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public static $table_name = 'orders';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', 'o.payment_method_id')
        ->select('o.*', 'pm.type','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->orwhere([
            ['o.order_id', 'LIKE', '%' . $filter->search . '%'],
            ['u.name', 'like', '%' . $filter->search . '%']
        ])
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_report_awaiting() {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query){
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
                ['o.status', '=', 1],
            ]);
        })
        ->get();
    }

    public static function get_report_unpaid() {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) {
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
            ]);
        })
        ->get();
    }

    public static function get_report_paid() {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) {
            $query->where([
                ['o.is_payment_sent', '=', 1],
                ['o.status', '!=', 12],
            ]);
        })
        ->get();
    }

    public static function get_report_archive() {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.id','o.order_id', 'o.date','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '>', 0) //check if this is deleted
        ->Where(function($query){
            $query->where([
                ['o.status', '!=', 12],
            ]);
        })
        ->get();
    }

    public static function get_awaiting_list($filter, $datatable = true) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
                ['o.status', '=', 1],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['o.order_id', 'LIKE', "%$filter->search%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if ($datatable) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }

        return $db->get();
    }

    public static function get_total_awaiting_list($filter) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
                ['o.status', '=', 1],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['o.order_id', 'LIKE', "%$filter->search%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function get_unpaid_list($filter, $datatable = true) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['o.order_id', 'LIKE', "%$filter->search%"],
                ['ost.status', 'LIKE', "%$filter->status%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if ($datatable) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_total_unpaid_list($filter) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 0],
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['o.order_id', 'LIKE', "%$filter->search%"],
                ['ost.status', 'LIKE', "%$filter->status%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_paid_list($filter, $datatable = true) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 1],
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if ($datatable) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_total_paid_list($filter) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.is_payment_sent', '=', 1],
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }


    public static function get_archive_list($filter, $datatable = true) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.id','o.order_id', 'o.date','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '>', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['ost.status', 'LIKE', "%$filter->status%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if ($datatable) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_total_archive_list($filter) {
        $db = DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->select('o.*','o.approved_date', 'pm.type', 'ost.status','u.id AS user_id', 'u.name', 'u.first_name', 'u.last_name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        // (SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = o.id)'), '=', 0) //check if this is deleted
        ->Where(function($query) use ($filter){
            $query->where([
                ['o.status', '!=', 12],
                ['pm.type', 'LIKE', "%$filter->paymentmethod%"],
                ['ost.status', 'LIKE', "%$filter->status%"],
            ]);
        })
        ->whereBetween('o.date', [
            date('Y-m-d', strtotime('-1 day', strtotime($filter->datefrom))),
            date('Y-m-d', strtotime('+1 day', strtotime($filter->dateto)))
        ]);
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function get_payment_method_list() {
        return DB::table('payment_method')
        ->select('*')
        ->get();
    }

    public static function get_status_list() {
        return DB::table('order_status_type')
        ->select('*')
        ->get();
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name . ' AS o')
        ->leftjoin('users AS u', 'u.id', '=', 'o.user_id')
        ->leftjoin('payment_method AS pm', 'pm.id', '=', 'o.payment_method_id')
        ->leftjoin('order_status_type AS ost', 'o.status', '=', 'ost.id')
        ->leftjoin('starbuck_location as sl', 'sl.id', '=', 'o.cash_location')
        ->select('o.*', 'u.*', 'o.date AS order_date','pm.type AS payment_method', 'ost.status as status_label','u.id AS user_id', 'u.name', DB::raw('(SELECT SUM(oi.price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        ->where('o.id', $id)
        ->first();
    }
    
}
