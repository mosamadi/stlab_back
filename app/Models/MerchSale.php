<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchSale extends Model
{
    use HasFactory;
    protected $fillable=['name','item_name','amount', 'price','created_at'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
