<?php

use Illuminate\Database\Seeder;
use App\Journal;
use App\User;

class JournalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            Auth::login($user);
            factory(App\Journal::class)->create(['user_id'=>$user->id]);
        }
    }
}
