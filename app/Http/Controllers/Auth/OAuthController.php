<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\IGoogleOAuthenticator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    //

    public function getGoogleOAuthLink(IGoogleOAuthenticator $googleOAuthenticator ){
        return $googleOAuthenticator->getRedirectUrl();
    }

    public function googleCallback(IGoogleOAuthenticator $googleOAuthenticator ){
        return $googleOAuthenticator->handleCallback();
    }
}
