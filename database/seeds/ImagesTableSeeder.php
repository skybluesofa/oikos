<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\Journal;
use App\Post;
use Skybluesofa\Microblog\Model\Scope\Journal\PrivacyScope;

class ImagesTableSeeder extends Seeder
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
                $image = factory(App\Image::class)->create([
                    'journal_id' => $journal->id,
                    'user_id' => $journal->user_id,
                ]);

                $posts = Post::where('journal_id', $journal->id)->pluck('id');
                if (count($posts)>0) {
                    $postId = $posts->random();

                    $image->posts()->attach($postId);
                }
            }
        }
    }
}
