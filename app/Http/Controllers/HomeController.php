<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\IndexRequest;
use App\Http\Resources\Home\IndexAllAppsResource;
use App\Http\Resources\Home\IndexResource;
use App\Models\App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller {
    public function index( IndexRequest $request ) {


        $orders = [
            'rating',
            'size',
            'reviews',
            'installs',
            'price',
        ];

        $per_page = $request->per_page > 1 ? $request->per_page : 20;

        $sort  = in_array( $request->orderby, $orders ) ? $request->orderby : 'installs';
        $order = $request->order == 'ASC' ? 'ASC' : 'DESC';


        /** @var LengthAwarePaginator $all_apps */
        $all_apps = App::groupBy( 'name' )->orderBy( $sort, $order )->paginate( $per_page );
        $all_apps = IndexResource::collection( $all_apps );


        if ( ! Cache::has( 'index_best_apps' ) ) {
            $best_apps = App::groupBy( 'name' )->orderByRaw( "(reviews/rating) DESC" )->get()->take( 10 );
            $best_apps = IndexResource::collection( $best_apps );

            Cache::put( 'index_best_apps', $best_apps, 60 * 60 ); //1 Hour cache
        } else {
            $best_apps = Cache::get( 'index_best_apps' );
        }

        if ( ! Cache::has( 'index_most_download' ) ) {
            $most_download = App::groupBy( 'name' )->orderByRaw( "length(installs) DESC" )->get()->take( 10 );
            $most_download = IndexResource::collection( $most_download );

            Cache::put( 'index_most_download', $most_download, 60 * 60 ); //1 Hour cache
        } else {
            $most_download = Cache::get( 'index_most_download' );
        }


        return [
            'all_apps'      => $all_apps,
            'best_apps'     => $best_apps,
            'most_download' => $most_download,
        ];

    }
}
