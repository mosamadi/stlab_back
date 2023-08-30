<?php


namespace App\Interfaces\Repositories;



use Illuminate\Support\Collection;

interface IUserRepository
{

    public function getAuthUser();
    public function monthlyTotalRevenue(): array;
    public function monthlyFollowers(): int;
    public function monthlyBestSellersItem($limit): Collection;

}
