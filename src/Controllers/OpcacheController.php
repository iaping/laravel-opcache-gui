<?php

namespace Aping\LaravelOpcacheGui\Controllers;

use Illuminate\Routing\Controller;

class OpcacheController extends Controller
{
    public function index()
    {
        return view('laravel-opcache-gui::index');
    }

}
