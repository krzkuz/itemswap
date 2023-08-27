<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Item;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();
        User::factory(1)->create();
        $tag = Tag::factory(1)->create();

        foreach ($users as $user){
            $item = Item::factory(1)->create([
                'user_id' => $user->id,
            ]);

            Message::factory(1)->create([
                'sender_id' => $user->id,
                'recipient_id' => $user->id + 1,
                'item_id' => $item->last()->id
            ]);

        }

    }
}
