<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Services\NotificationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    private NotificationService $notificationService;
    private UserService $userService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->userService = new UserService();
        $this->middleware(TokenMiddleware::class);
    }


    public function findAllNotificationsUser(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        $notifications = $this->notificationService->findAllNotificationsUser($userId);
        return ResponseHelper::successResponse("Success Fetch data", $notifications, 200);
    }

}
