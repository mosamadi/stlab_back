<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /* */
        $notification = $this;
        return [
            'id' => $notification->id,
            'msg' => $notification->data["message"],
            'type'=> $notification->data["details"]["type"],
            'is_read' => $notification->read_at ? true : false

        ];
    }
}
