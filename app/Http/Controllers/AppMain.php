<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Admin as ModelAdmin;

class AppMain extends BaseController
{
    public function index(Request $request) {
        
        return view('user.index', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
            // 'devices' => ModelAdmin\Device::get_all(),
            // 'brand_list' => ModelAdmin\Brand::get_all(),
            // 'reviews' => ModelAdmin\Review::get_all(),
            // 'menus' => ModelAdmin\Menu::get_client_menu(),
        ]);
    }

    public function pages(Request $request) {
    }

    public function reviews(Request $request) {
        return view('user.reviews', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function order_track(Request $request) {
        return view('user.order-track', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function support(Request $request) {
        return view('user.support', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function bulk_sales(Request $request) {
        return view('user.bulk-sales', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function review_order(Request $request) {
        return view('user.cart', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function device_brand(Request $request) {
        return view('user.device-brand', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }

    public function model_list($device) {
        $is_device = (bool)request()->routeIs('client-device-list');
        $get_list = $is_device ? ModelAdmin\Device::get_id_by_url($device) : ModelAdmin\Brand::get_id_by_url($device);
        $column_toget = $is_device ? 'device' : 'brand';
        return view('user.model-list', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
            'title' => $get_list->title,
            'models' => ModelAdmin\Models::get_by($column_toget, $get_list->id),
        ]);
    }
}
