<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{
    use HasFactory;

    public static function get_post() {
        return DB::select('SELECT * FROM blog_post ORDER BY date_posted DESC');
    }

    public static function get_post_by_cat($category) {
        return DB::select('SELECT DISTINCT bp.blog_id, bp.*, bpt.name FROM blog_post AS bp LEFT JOIN blog_post_category AS bpc ON bp.blog_id = bpc.blog_id LEFT JOIN blog_post_tag AS bpt ON bpc.bpt_id = bpt.bpt_id WHERE bpt.name = ?', [$category]);
    }

    public static function get_recent_post() {
        return DB::select('SELECT * FROM blog_post ORDER BY date_posted DESC LIMIT 5');
    }

    public static function get_post_category_by_blog() {
        return DB::select('SELECT bpc.*, bpt.name FROM blog_post_category AS bpc LEFT JOIN blog_post_tag AS bpt ON bpc.bpt_id = bpt.bpt_id LEFT JOIN blog_post AS bp ON bpc.blog_id = bp.blog_id');
    }
    
    public static function get_catogires() {
        return DB::select('SELECT name FROM blog_post_tag ORDER BY bpt_id ASC');
    }

    public static function get_post_by_id($id) {
        return DB::select('SELECT * FROM blog_post WHERE blog_id = ?', [$id]);
    }
}
