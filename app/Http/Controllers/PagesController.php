<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // public function index(){
    //     return view('');
    // }

    public function login(){
        return view('auth/login');
    }

    public function cadastro(){
        return view('auth/cadastro');
    }
}
