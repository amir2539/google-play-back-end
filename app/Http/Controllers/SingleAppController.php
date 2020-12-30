<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\IndexResource;
use App\Http\Resources\Single\getAppReviewResource;
use App\Models\App;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SingleAppController extends Controller
{
    public function getApp(Request $request, $app)
    {
        $appName = $app;

        if (!Cache::has("single_app".$appName)) {
            $app = App::AppName($app)->firstOrFail();
            $app = new IndexResource($app);
            Cache::put("single_app".$appName, $app, 60 * 60);
        } else {
            $app = Cache::get("single_app".$appName);
        }

        if (!Cache::has("single_review".$appName)) {
            $reviews = Review::AppName($appName)->paginate(20);
            $reviews = getAppReviewResource::collection($reviews);
            Cache::put("single_review".$appName, $reviews, 60 * 60);
        } else {
            $reviews = Cache::get("single_review".$appName);
        }


        return [
            'app' => $app,
            'reviews' => $reviews
        ];
    }
}
