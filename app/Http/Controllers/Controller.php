<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function create ()
    {
        return view('comments.create');
    }
}
