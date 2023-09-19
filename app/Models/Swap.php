<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_confirmed',
        'owner_a',
        'owner_b',
        'item_a',
        'item_b'
    ];

    public function ownerA(){
        return $this->belongsTo(User::class, 'owner_a');
    }

    public function ownerB(){
        return $this->belongsTo(User::class, 'owner_b');
    }

    public function itemA(){
        return $this->belongsTo(Item::class, 'item_a');
    }

    public function itemB(){
        return $this->belongsTo(Item::class, 'item_b');
    }
}
