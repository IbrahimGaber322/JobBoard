<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;

        return $notifications;
    }
}
