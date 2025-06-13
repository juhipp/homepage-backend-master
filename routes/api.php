<?php

use App\Http\Controllers;
use App\Services\MailService;
use App\Services\TrackService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResources([
            'articles' => Controllers\ArticleController::class,
            'jobs' => Controllers\JobController::class,
            'job-categories' => Controllers\JobCategoryController::class,
            'users' => Controllers\UserController::class,
            'article-categories' => Controllers\ArticleCategoryController::class,
        ]);

        Route::get('me', [Controllers\MeController::class, 'user']);
        Route::post('me/token', [Controllers\MeController::class, 'issueToken']);
        Route::delete('me/token/{personal_access_token}', [Controllers\MeController::class, 'revokeToken']);
        Route::post('articles/{article}/categories/{articleCategory}', [Controllers\ArticleController::class, 'attachCategory']);
        Route::delete('articles/{article}/categories/{articleCategory}', [Controllers\ArticleController::class, 'detachCategory']);
        Route::delete('auth', [Controllers\SPAAuthController::class, 'logout']);
    });

    Route::post('uploads', [Controllers\UploadsController::class, 'upload']);
    Route::get('uploads/{filename}', [Controllers\UploadsController::class, 'file']);

    Route::post('auth/login', [Controllers\SPAAuthController::class, 'login']);

    Route::get('feed/jobs', [Controllers\FeedController::class, 'jobs']);
    Route::get('feed/jobs/{job}', [Controllers\FeedController::class, 'job'])->name('feed.jobs.show');

    Route::get('feed/articles', [Controllers\FeedController::class, 'articles']);
    Route::get('feed/articles/{article}', [Controllers\FeedController::class, 'article'])->name('feed.articles.show');
    Route::post('mail', function (Request $request) {
        app(MailService::class)->phpmailer(
            env('MAILRECEIVER', 'mirko.ozekker@leadity.de'),
            'Anfrage über Homepage: '.$request->input('subject'),
            'Name: '.$request->input('name').
            '<br>Firma: '.$request->input('firma').
            '<br>E-Mail: '.$request->input('email').
            '<br>Telefon: '.$request->input('tele').
            '<br>Session: '.$request->input('session').
            '<br>Nachricht:<br>'.$request->input('text'));
    });
    Route::put('track', fn(Request $request) => app(TrackService::class)->track($request));
});

Route::fallback(function () {
    return Redirect::to(config('app.web_url'));
});
