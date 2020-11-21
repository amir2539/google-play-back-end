<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\IndexResource;
use App\Http\Resources\Single\getAppReviewResource;
use App\Models\App;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleAppController extends Controller {
    public function getApp( Request $request, $app ) {

        $appName = $app;

        $app = App::AppName( $app )->firstOrFail();
        $app = new IndexResource($app);

        $reviews = Review::AppName( $appName )->paginate(20);
        $reviews = getAppReviewResource::collection($reviews);

        return [
            'app' => $app,
            'reviews' => $reviews
        ];

    }
}
