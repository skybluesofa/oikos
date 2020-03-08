<?php

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Journal;
use Skybluesofa\Microblog\Model\Scope\Post\PrivacyScope as PostPrivacyScope;
use Skybluesofa\Microblog\Model\Scope\Post\PublicScope as PostPublicScope;
use Skybluesofa\Microblog\Model\Scope\Journal\PrivacyScope as JournalPrivacyScope;
use Skybluesofa\ImageBarbershop\Trim;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/crop', function (Request $request) {
    $filename = 'health-52e8d34242_1280';
    $filepath = __DIR__ . '/../storage/app/public/' . $filename . '.jpg';

    $croppedImage = Trim::makeCut()->on($filepath)->toSize(750, 300)->getResults();
    $croppedImage->writeimage(__DIR__ . '/../storage/app/public/' . $filename . '.cropped.jpg');
});

Route::get('/stream', function (Request $request) {
    $apiToken = '8sO50USaBQyeNudrrvoIkQ8bLZFl58eJvyOaEqhUYA5BuM7YDToUMoE5tWC1TV95gxrdAETAJOaQp8PZ';

    $uri = '/api/stream?api_token=' . $apiToken;
    $request = Request::create($uri, 'GET');
    $response = app()->handle($request);

    return $response;

    return view('stream', ['entries' => $response->getData()->data]);
});

Route::prefix('publishing')->group(function () {
    $apiToken = '8sO50USaBQyeNudrrvoIkQ8bLZFl58eJvyOaEqhUYA5BuM7YDToUMoE5tWC1TV95gxrdAETAJOaQp8PZ';

    Route::get('/journal/{journal}', function (Request $request, string $journalId) use ($apiToken) {

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
