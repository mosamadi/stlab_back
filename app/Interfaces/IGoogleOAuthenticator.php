<?php


namespace App\Interfaces;


interface IGoogleOAuthenticator
{

    public function getRedirectUrl();
    public function handleCallback();

}
