<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hash = '8sO50USaBQyeNudrrvoIkQ8bLZFl58eJvyOaEqhUYA5BuM7YDToUMoE5tWC1TV95gxrdAETAJOaQp8PZ';

        factory(App\User::class)->create([
            'name' => 'Dave Rogers',
            'email' => 'drogers@dealerinspire.com',
            'password' => '$2y$10$QNH52jRR6.8TFOYHXVLMAuAj.hLMc6EQYOR16kHqz1KjDfmUgG5lS',
            'api_token' => hash('sha256', $hash),
        ]);

        factory(App\User::class, 9)->create();
    }
}
