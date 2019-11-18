<?php

namespace Aping\LaravelOpcacheGui\Controllers;

use Aping\LaravelOpcacheGui\Opcache;
use Illuminate\Routing\Controller;

class OpcacheController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $opcache = new Opcache();

        return view('laravel-opcache-gui::index', compact('opcache'));
    }

}
