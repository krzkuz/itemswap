<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'item_id',
        'sender_id',
        'recipient_id'
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient(){
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
