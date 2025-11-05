<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffsController extends Controller
{
    public function index() {
        $staffs = Staff::all();
        return view('staffs', ['staffs' => $staffs]);
    }
}
