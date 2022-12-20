<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoriesController extends Controller
{
    public function all(){
        return dd(Category::all());
    }
}
