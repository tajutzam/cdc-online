<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function send(HttpRequest $request)
    {
        $rules = [
            'users' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $this->validate($request, $rules, $customMessages);
        $users = json_decode($request->input('users'));
        $this->notificationService->sendNotificationQuisioner($users);
        Alert::success("Sukses", "Sukses Mengirim Notifikasi User");
        return back();
    }
}
