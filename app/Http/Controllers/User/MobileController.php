<?php

namespace App\Http\Controllers\User;

use App\Models\Admin\Brand;
use App\Models\User\Mobile;
use App\Models\Admin\Device;
use App\Models\Admin\Models;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;



class MobileController extends Controller
{
    public function index($id = null)
    {
        $mobiles = $id == null ? Models::get_all() : Models::get_list_by('devices', decrypt($id));
        return view('user.sub-pages.sell-phone')->with([
            'mobiles' => $mobiles, 
            'categories' => Category::all(),
            'brands' => Brand::get_all(),
            'devices' => Device::get_all(),
        ]);
    }

    public function getMobileByModel($model, $id)
    {  
        $mobiles = $model == 'all' ?  Models::get_all() : Models::get_list_by($model, decrypt($id));
        return response()->json(['mobiles' => $mobiles]);
    }

    public function search(Request $request)
    {  
   
        return view('user.search-page')->with([
            'mobiles' => Models::search($request->keyword),            
            'devices' => Device::get_all(),
            'keyword' => $request->keyword,
        ]);
    }
    
    
  
}
