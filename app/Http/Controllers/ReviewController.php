<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\AddCommentRequest;
use App\Models\App;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addComment(AddCommentRequest $request)
    {

        /** @var App $app */
        $app = App::AppName($request->app)->first;

        $credentials = $request->only('app', 'review', 'sentiment', 'sentiment_subjectivity', 'sentiment_polarity');
        Review::create($credentials);

        //calculate app rating
        $reviewCount = $app->reviews;
        $rating = $app->rating;

        $app->reviews = $reviewCount + 1;

        $reviewAverage = (($request->sentiment_polarity * 2) + ($request->sentiment_subjectivity * 2));

        if ($request->sentiment == "positive") {
            $sentiment = 1;
        } else if ($request->sentiment == "negative") {
            $sentiment = 0;
        } else {
            $sentiment = 0.5;
        }

        $reviewAverage = floatval($reviewAverage + $sentiment);

        $app->rating = floatval((($reviewCount * $rating) + $reviewAverage) / ($app->reviews));

        $app->save();

        return [
            'review' => $credentials
        ];

    }
}
