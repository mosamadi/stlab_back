<?php


namespace App\Interfaces\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserNotificationRepository
{


    public function markAsRead($id): bool;

    public function markAsUnread($id): bool;

    public function findById($id): Model;

    public function list_all($limit): LengthAwarePaginator;

    public function list_unread($limit): LengthAwarePaginator;

    public function list_read($limit): LengthAwarePaginator;

    public function set_notifiable(Model $model);
}
