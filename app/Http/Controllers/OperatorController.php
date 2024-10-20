<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function operatortable(){
        return view('admin.operatortable');
    }
}
