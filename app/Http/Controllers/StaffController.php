<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;

class StaffController extends Controller {


    public function showPannelloStaff() {
        return view('staff.pannello_staff');
    }


    public function index() {
        return view('admin');
    }


}
