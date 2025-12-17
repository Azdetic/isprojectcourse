<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_name',
        'name',
        'price',
        'category',
        'description',
        'image',
        'location',
        'rating',
        'reviews_count',
    ];

    // Relationship with User (Seller)
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Accessor for 'seller' attribute to match legacy static data
    public function getSellerAttribute()
    {
        return $this->seller_name ?? ($this->seller ? $this->seller->name : 'Unknown');
    }

    // Accessor for 'posted' attribute to match legacy static data
    public function getPostedAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : 'Recently';
    }

    public static function getAll()
    {
        return self::all();
    }
}

