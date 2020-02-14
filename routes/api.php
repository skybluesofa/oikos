<?php

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Journal;
use Skybluesofa\Microblog\Model\Scope\Post\PrivacyScope as PostPrivacyScope;
use Skybluesofa\Microblog\Model\Scope\Post\PublicScope as PostPublicScope;
use Skybluesofa\Microblog\Model\Scope\Journal\PrivacyScope as JournalPrivacyScope;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Journal as JournalResource;
use App\Http\Resources\PostCollection as PostResourceCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        $currentUser = $request->user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        return new UserResource($request->user());
    });

    Route::get('/user/journal', function (Request $request) {
        $currentUser = $request->user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        return new JournalResource(
            Journal::where('user_id', $currentUser->id)
                ->first()
        );
    });

    Route::get('/user/posts', function (Request $request) {
        $currentUser = $request->user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        return new PostResourceCollection(
            Post::where('user_id', $currentUser->id)
                ->get()
        );
    });

    Route::get('/journal/{journal}/user', function (Request $request, $journalId) {
        $currentUser = $request->user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        return new UserResource(
            Journal::withoutGlobalScope(JournalPrivacyScope::class)
                ->where('id', $journalId)
                ->first()
                ->user
        );
    });

    Route::get('/journal/{journal}/posts', function (Request $request, Journal $journal) {
        $currentUser = Auth::user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        if ($currentUser->id == $journal->user_id) {
            $posts = Post::WhereUserIdIs($currentUser->id)
                ->withoutGlobalScope(PostPrivacyScope::class);
        } else {
            $posts = Post::wherePublic()
                ->wherePublished()
                ->whereUserIdIs($journal->user_id)
                ->withoutGlobalScope(PostPrivacyScope::class);
        }

        return new PostResourceCollection(
            $posts->get()
        );
    });

    Route::get('/journal/{journal}/{post}', function (Request $request, Journal $journal, Post $post) {
        $currentUser = Auth::user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }

        if ($currentUser->id == $journal->user_id) {
            $posts = Post::WhereUserIdIs($currentUser->id)
                ->where('journal_id', $journal->id)
                ->withoutGlobalScope(PostPrivacyScope::class);
        } else {
            $posts = Post::WherePublic()
                ->wherePublished()
                ->whereUserIdIs($journal->user_id)
                ->whereJournalIdIs($journal->id)
                ->withoutGlobalScope(PostPrivacyScope::class);
        }
        return new PostResourceCollection(
            $posts->get()
        );
    });

    Route::get('/shared/journal/{journal}/posts', function (Request $request, Journal $journal) {
        $posts = Post::withoutGlobalScope(PostPrivacyScope::class);

        return new PostResourceCollection(
            $posts->get()
        );
    });

    Route::get('/publish/journal/{journal}', function (Request $request, string $journalId) {
        $currentUser = Auth::user();

        if (!$currentUser) {
            abort(403, 'Unauthorized action.');
        }
    
        print_r($request->all());die();
        $apiToken = '8sO50USaBQyeNudrrvoIkQ8bLZFl58eJvyOaEqhUYA5BuM7YDToUMoE5tWC1TV95gxrdAETAJOaQp8PZ';
    
        $uri = '/api/shared/journal/'. $journalId . '/posts?api_token=' . $apiToken;
        $request = Request::create($uri, 'GET');
        $response = app()->handle($request)->getData();

        //print "<pre>";print_r($response);die();
        $pdfContent  = "<style>";
        $pdfContent .= ".post H2 { font-size:14pt;margin:0; }";
        $pdfContent .= ".post { orphans:4; widows:4; margin:0 0 14pt 0; }";
        $pdfContent .= ".post .content p { margin:7pt 0 0 0; font-size:11pt }";
        $pdfContent .= ".post .by-line { text-align:right;font-size:9pt;margin:7pt 0 0 0; }";
        $pdfContent .= "BODY { page:doublepage; }";
        $pdfContent .= "@page :left { margin-left: 2cm; margin-right: 3cm; } @page :right { margin-left: 3cm; margin-right: 2cm; }";
        $pdfContent .= "</style>";

        $currentDate = null;
        foreach ($response->data as $post) {
            $date = strtotime($post->available_on);
            $day = date('l', $date);
            $dateDescription = date('F j, Y', $date);

            if ($dateDescription != $currentDate) {
                $currentDate = $dateDescription;
                $pdfContent .= '<h1 style="widow:0;orphan:0;text-align:right;font-size:12pt;margin:0 0 8px 14pt;line-height:1.5;">' . $day . ', ' . $dateDescription . '</h1>';
            }
            $pdfContent .= '<div class="post">';
            $pdfContent .= '<h2>' . $post->title . '</h2>';
            $pdfContent .= '<div class="content"><p>' . str_replace("\n", "</p><p>", $post->content) . '</p></div>';
            $pdfContent .= '<div class="by-line">' . $post->user . '</div>';
            $pdfContent .= '</div>';
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($pdfContent);
        return $pdf->stream();
    });
});
