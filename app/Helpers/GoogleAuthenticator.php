<?php


namespace App\Helpers;


use App\Interfaces\IGoogleOAuthenticator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthenticator implements IGoogleOAuthenticator
{

    public function getRedirectUrl()
    {
        if (Auth::user()) return $this->getLoggedInResponse();
        return response()->json([
            'success' => true,
            'auth_url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ],201);
    }

    public function handleCallback()
    {

        try {
            $GUser = Socialite::driver('google')->stateless()->user();
            $user_created = User::firstOrCreate(['email' => $GUser->getEmail()],
                ['password' => Hash::make(Str::random(8)), 'email_verified_at' => now(),
                    'name' => $GUser->getName()]);
            $user_created->OAuthProviders()->updateOrCreate(['oauth_provider' => 'google'],
                ['oauth_id' => $GUser->getId()]);

            $token = $user_created->createToken("google-oauth")->plainTextToken;

            return response()->json([
                "success" => true,
                "authorization" => [
                    "type" => "Bearer",
                    "token" => $token
                ],
            ], 200);

        } catch (Throwable $th) {
            return response()->json([
                "success" => false,
                "error" => [
                    "message" => $th->getMessage(),
                    "code" => $th->getCode(),
                ]
            ], 422);
        }

    }

    public function getLoggedInResponse(){
        $token = Auth::guard('sanctum')->user()->createToken("google-oauth")->plainTextToken;
        return response()->json([
            "success" => true,
            "authorization" => [
                "type" => "Bearer",
                "token" => $token
            ],
        ], 200);
    }
}
