<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'participant1_id',
        'participant2_id'
    ];
    
    public function participant1(){
        return $this->belongsTo(User::class, 'participant1_id');
    }

    public function participant2(){
        return $this->belongsTo(User::class, 'participant2_id');
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function messages(){
        return $this->hasMany(Message::class)
            ->orderBy('created_at', 'asc');
    }
}
