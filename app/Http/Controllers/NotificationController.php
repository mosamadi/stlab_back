<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationStatusUpdateRequest;
use App\Http\Resources\NotificationResource;
use App\Interfaces\Repositories\IUserNotificationRepository;
use App\Interfaces\Repositories\IUserRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function index(IUserNotificationRepository $notificationRepository, IUserRepository $userRepository){

        $user = $userRepository->getAuthUser();

        $notificationRepository->set_notifiable($user);


        return NotificationResource::collection($notificationRepository->list_all(100))
            ->response()->getData(true);

    }

    public function updateNotification(IUserNotificationRepository $notificationRepository, IUserRepository $userRepository,
                                       NotificationStatusUpdateRequest $request)
    {


        $user = $userRepository->getAuthUser();
        $notificationRepository->set_notifiable($user);
        if ($request->input('notification_read')) {
            $status = $notificationRepository->markAsRead($request->input('notification_id'));
        } else {
            $status = $notificationRepository->markAsUnread($request->input('notification_id'));
        }
        return response()->json(["status" => $status]);


    }
}
