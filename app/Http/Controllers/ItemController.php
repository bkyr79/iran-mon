<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    function show(){
        return view("upload_form");
    }

    function upload(Request $request){

    }
}
