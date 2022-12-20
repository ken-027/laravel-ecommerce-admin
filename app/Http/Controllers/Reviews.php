<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Admin as ModelAdmin;

class Reviews extends BaseController
{
    public function index(Request $request) {
        
        return view('user.reviews', [
            'setting_info' => ModelAdmin\GeneralSetting::get_list(),
        ]);
    }
}
