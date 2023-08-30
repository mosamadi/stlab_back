<?php


namespace App\Repositories;


use App\Interfaces\Repositories\IUserNotificationRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class UserNotificationRepository implements IUserNotificationRepository
{


    private $user;

    /**
     * UserNotificationRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function markAsRead($id): bool
    {
        return $this->user->notifications()->where(['id' => $id])->update(["read_at" => now()]) > 0;
    }

    public function markAsUnread($id): bool
    {
        return $this->user->notifications()->where(['id' => $id])->update(["read_at" => null]) > 0;
    }

    public function findById($id): Model
    {

    }

    public function list_all($limit): LengthAwarePaginator
    {
        return $this->user->notifications()->orderBy('created_at')->paginate($limit);

    }

    public function list_unread($limit): LengthAwarePaginator
    {

    }

    public function list_read($limit): LengthAwarePaginator
    {

    }

    public function set_notifiable(Model $model)
    {
        $this->user = $model;
    }
}
