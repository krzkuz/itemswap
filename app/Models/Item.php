<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, array $filters){
        if ($filters['tag'] ?? false) {
            $query->whereHas('tags', function(Builder $tagQuery){
                $tagQuery->where('name', 'like', '%' . request('tag') . '%');
            });
        }

        if ($filters['search'] ?? false){
            $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhereHas('tags', function(Builder $tagQuery){
                $tagQuery->where('name', 'like', '%' . request('search') . '%');
            });
        }

        if($filters['location'] ?? false){
            $query->whereHas('owner', function(Builder $locationQuery){
                $locationQuery->where('city', request('location'));
            });
        }
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function images(){
        return $this->hasMany(Image::class)
            ->orderBy('is_main', 'desc');
    }

    public function swapsOffered(){
        return $this->hasMany(Swap::class, 'item_b');
    }

    public function swapsReceived(){
        return $this->hasMany(Swap::class, 'item_a');
    }
}
