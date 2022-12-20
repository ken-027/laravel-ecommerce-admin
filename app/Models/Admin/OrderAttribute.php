<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrderAttribute extends Model
{   
    public static $table_name = [
        'status_type' => 'order_status_type',
        'item' => 'order_items',
    ];

    public static function get_status_type_list() {
        return DB::table(self::$table_name['status_type'])
        ->select('*')
        ->get();
    }

    public static function get_item_list($id) {
        // $query=mysqli_query($db,"SELECT oi.*, `, , , , , , , , , `, ,, , ,, , , 
        // d.title AS device_title, 
        // m.title AS model_title, m.model_img, 
        // b.title AS brand_title, b.is_check_icloud, 
        // c.fields_type AS fields_cat_type 
        // FROM order_items AS oi 
        // LEFT JOIN orders AS o ON o.order_id=oi.order_id 
        // LEFT JOIN devices AS d ON d.id=oi.device_id 
        // LEFT JOIN mobile AS m ON m.id=oi.model_id 
        // LEFT JOIN brand AS b ON b.id=m.brand_id 
        // LEFT JOIN categories AS c ON c.id=m.cat_id 
        // WHERE oi.order_id='".$order_id."' ORDER BY oi.id DESC");

        return DB::table(self::$table_name['item'] . ' AS oi')
        ->leftjoin('orders AS o', 'o.order_id', 'oi.order_id')
        ->leftjoin('devices AS d', 'd.id', 'oi.device_id')
        ->leftjoin('mobile AS m', 'm.id', 'oi.model_id')
        ->leftjoin('brand AS b', 'b.id', 'm.brand_id')
        ->leftjoin('categories AS c', 'c.id', 'm.cat_id')
        // ->select('oi.*', 'o.payment_method', 'o.date', 'o.approved_date', 'o.expire_date', 'o.status', 'o.sales_pack', 'o.paypal_address', 'o.chk_name', 'o.chk_street_address', 'o.chk_street_address_2', 'o.chk_city', ' o.chk_state', 'o.chk_zip_code', 'o.act_name', 'o.act_number', 'o.act_short_code', 'o.note')
        ->select('oi.*', 'oi.id AS order_item_id', 'o.*', 'o.id AS id_order', 'm.title AS model_title', 'd.title AS device_title', 'b.title AS brand_title')
        ->where('o.id', $id)
        ->get();
    }
}