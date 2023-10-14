<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{

    public function index()
    {
        return view('admin.notifications.notifications');
    }
}