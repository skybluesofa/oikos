<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Journal;
use Skybluesofa\Microblog\Model\Scope\Journal\PrivacyScope;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Journal::withoutGlobalScope(PrivacyScope::class)->get() as $journal) {
            for ($i = 0; $i < 5; $i++) {
                factory(App\Post::class)->create([
                    'journal_id' => $journal->id,
                    'user_id' => $journal->user_id,
                    'available_on' => (new DateTime)->modify(rand(-99999, 99999).' minutes')
                ]);
            }
        }
    }
}
