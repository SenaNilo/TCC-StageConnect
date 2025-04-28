<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages/test');
    }

    public function login(){
        return view('login');
    }

    public function cadastro(){
        return view('cadastro');
    }
}
