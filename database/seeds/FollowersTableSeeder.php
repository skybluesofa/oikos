<?php

use Illuminate\Database\Seeder;
use App\User;
use Skybluesofa\Followers\Models\Follower;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            for ($i = 0; $i < 4; $i++) {
                $existingSenders = Follower::where('recipient_id', $user->id)->pluck('sender_id');
                $existingSenders[] = $user->id;

                $senderId = User::whereNotIn('id', $existingSenders)->inRandomOrder()->first()->id;
                factory(Follower::class)->create([
                    'sender_id' => $senderId,
                    'recipient_id' => $user->id,
                ]);
            }
        }
    }
}
