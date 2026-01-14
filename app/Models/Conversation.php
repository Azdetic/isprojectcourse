<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_one', 'user_two'];

    /**
     * Get the messages for the conversation.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the first user in the conversation.
     */
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one');
    }

    /**
     * Get the second user in the conversation.
     */
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two');
    }
}