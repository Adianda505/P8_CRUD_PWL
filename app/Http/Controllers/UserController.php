<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    Protected $request;
    public function index(){
        return view('home');
    }

    public function show(Request $request){
        $name = $request->input('name');
        return $name;
    }

    public function __construct(Request $request){
        $this->request = $request;
    }
}
