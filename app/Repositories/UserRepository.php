<?php


namespace App\Repositories;


use App\Interfaces\Repositories\IUserNotificationRepository;
use App\Interfaces\Repositories\IUserRepository;
use App\Models\Donation;
use App\Models\UserSubscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserRepository implements IUserRepository
{

    public function getAuthUser()
    {
        /** @var User $user */
        $user = Auth::guard('sanctum')->user();
        return $user;
    }

    public function monthlyTotalSubscriptionsRevenue()
    {
        $date = Carbon::now()->subDays(30);
        $total_USD = 0;
        $subscriptions = $this->getAuthUser()->UserSubscribers()->where("created_at", ">", $date)->select('subscription', DB::raw('count(id) as cnt'))
            ->groupBy('subscription')->get();

        foreach ($subscriptions as $subscription) {
            switch ($subscription->subscription) {
                case UserSubscriber::SUBSCRIPTION_TIER1:
                    $total_USD += $subscription->cnt * UserSubscriber::SUBSCRIPTION_TIER1_PRICE;
                    break;
                case UserSubscriber::SUBSCRIPTION_TIER2:
                    $total_USD += $subscription->cnt * UserSubscriber::SUBSCRIPTION_TIER2_PRICE;
                    break;
                case UserSubscriber::SUBSCRIPTION_TIER3:
                    $total_USD += $subscription->cnt * UserSubscriber::SUBSCRIPTION_TIER3_PRICE;
                    break;

            }

        }

        return ["USD" => $total_USD, "EUR" => 0];
    }

    public function monthlyTotalDonationsRevenue()
    {
        $date = Carbon::now()->subDays(30);
        $total_USD = 0;
        $total_EUR = 0;
        $donations = $this->getAuthUser()->donations()->where("created_at", ">", $date)->select('currency', DB::raw('sum(amount) as total'))
            ->groupBy('currency')->get();
        foreach ($donations as $donation) {
            if ($donation->currency == "USD") {
                $total_USD += $donation->total;
            } elseif ($donation->currency == "EUR") {
                $total_EUR += $donation->total;
            }


        }

        return ["USD" => $total_USD, "EUR" => $total_EUR];
    }

    public function monthlyTotalMerchSalesRevenue()
    {
        $date = Carbon::now()->subDays(30);
        return ["USD" => $this->getAuthUser()->merchSales()->where("created_at", ">", $date)->sum('price'), "EUR" => 0];
    }

    public function monthlyTotalRevenue(): array
    {

        $donation_revenue = $this->monthlyTotalDonationsRevenue();
        $subscription_revenue = $this->monthlyTotalSubscriptionsRevenue();
        $merch_sales_revenue = $this->monthlyTotalMerchSalesRevenue();

        return ["USD" => $donation_revenue["USD"] + $subscription_revenue["USD"] + $merch_sales_revenue["USD"],
            "EUR" => $donation_revenue["EUR"] + $subscription_revenue["EUR"] + $merch_sales_revenue["EUR"],
        ];
    }

    public function monthlyFollowers(): int
    {
        $date = Carbon::now()->subDays(30);

        return $this->getAuthUser()->followers()->where("created_at", ">", $date)->count();
    }

    public function monthlyBestSellersItem($limit): Collection
    {
        $date = Carbon::now()->subDays(30);
        return $this->getAuthUser()->merchSales()->where("created_at", ">", $date)
            ->groupBy('item_name')->
            select('item_name', DB::raw('sum(price) as total_revenue'))
            ->orderBy('total_revenue', 'desc')->limit(3)->get();
    }
}
