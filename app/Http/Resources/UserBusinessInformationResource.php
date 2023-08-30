<?php


namespace App\Http\Resources;


use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Notifications\Notification;

class UserBusinessInformationResource extends JsonResource
{


    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request)
    {
        /** @var UserRepository $user_repository */
        $user_repository = $this;
        return [
            "monthly_followers" => $user_repository->monthlyFollowers(),
            "monthly_total_revenue" => $user_repository->monthlyTotalRevenue(),
            "monthly_best_sellers_item" => $user_repository->monthlyBestSellersItem(3)

        ];
    }
}
