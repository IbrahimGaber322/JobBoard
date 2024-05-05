<?php

namespace App\Http\Controllers;
use Inertia\Inertia;


class DemoController extends Controller
{
    public function index()
    {
        return Inertia::render('Demo/Index');
    }
}
