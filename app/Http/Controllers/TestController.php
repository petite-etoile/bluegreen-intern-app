<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function handle(){
        return view("welcome", ["test" => "abcabc"]);
    }
}
