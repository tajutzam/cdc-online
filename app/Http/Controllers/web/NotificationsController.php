<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;

class NotificationsController extends Controller
{

    private NotificationService $notificationService;


    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    public function index()
    {


        $data = $this->notificationService->findAllUserNeedNotifications();


        return view('admin.notifications.notifications', ['data' => $data]);
    }
    


}