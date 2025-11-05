<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    // Ensures so that the code goes to the table staffs, since there is a bug with the migration
    protected $table = "staffs";
    protected $fillable = ['name', 'position'];

    // public function getStaffs() {
    //     return self::all();
    // }
}
