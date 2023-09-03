<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
