<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Models;

class Ordering extends Controller
{
    public function order_save(Request $request) {
        $request->validate([
            'orders' => 'required',
        ]);

        $arr_res = [];
        foreach($request->orders as $key => $order) {
            $order = (object)$order;
            $arr_res[$key] = $this->save($order->id, $order->order);
        }

        return response()->json([
            'is_ordersave' => $arr_res
        ]);
    }

    protected function save($id, $order) {
        $route = request()->route()->getName();
        switch ($route) {
            case 'category-ordering':
                return (bool)Models\Category::update_ordering(decrypt($id), $order);
            break;
            case 'brand-ordering':
                return (bool)Models\Brand::update_ordering(decrypt($id), $order);
            break;
            case 'device-ordering':
                return (bool)Models\Device::update_ordering(decrypt($id), $order);
            break;
            case 'model-ordering':
                return (bool)Models\Models::update_ordering(decrypt($id), $order);
            break;
            case 'menu-ordering':
                return (bool)Models\Menu::update_ordering(decrypt($id), $order);
            break;
            case 'starbuck-ordering':
                return (bool)Models\StarbuckLocation::update_ordering(decrypt($id), $order);
            break;
            case 'faq-ordering':
                return (bool)Models\Faq::update_ordering(decrypt($id), $order);
            break;
            case 'faqgroup-ordering':
                return (bool)Models\FaqGroup::update_ordering(decrypt($id), $order);
            break;
            
            default:
                # code...
                break;
        }
    }
}
