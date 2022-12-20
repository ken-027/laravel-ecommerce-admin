<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Profile extends Model
{
    public static function get_list($filter) {
        return DB::table('categories')
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('id','title', 'image', 'fields_type','ordering','published')   
        ->where('fields_type', 'LIKE', '%' . $filter->search . '%')
        ->orWhere('title', 'like', '%' . $filter->search . '%')
        ->limit($filter->limit)
        ->get();
    }
    
}
