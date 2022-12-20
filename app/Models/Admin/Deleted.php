<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Deleted extends Model
{
    public static $table_name = 'deleted';

    public static function insert($table_name, $table_id) {
        return DB::insert('INSERT INTO ' . self::$table_name . '(table_name, table_id) VALUES(?, ?)', [$table_name, $table_id]);
    }

    public static function restore($table_name, $table_id) {
        return DB::delete('DELETE FROM ' . self::$table_name . ' where table_name = ? AND table_id = ?', [$table_name, $table_id]);
    }
}
