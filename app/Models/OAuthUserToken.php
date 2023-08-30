<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthUserToken extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'oauth_provider', 'oauth_id'];
    protected $date = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
