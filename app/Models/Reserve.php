<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reserve extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime:d M Y ',
    ];

    protected $fillable = ['start_time'];

    public function hasEnded()
    {
        return Carbon::parse($this->start_time)->isPast();
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_no', 'id');
    }
}
