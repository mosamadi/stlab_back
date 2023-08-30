<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserBusinessInformationResource;
use App\Interfaces\Repositories\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userMonthlyActivity(IUserRepository $userRepository){

        return response()->json(
            UserBusinessInformationResource::make($userRepository)
        );

    }


}
