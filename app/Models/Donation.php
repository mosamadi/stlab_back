<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['name','amount', 'currency', 'donation_message', 'user_id','created_at'];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
