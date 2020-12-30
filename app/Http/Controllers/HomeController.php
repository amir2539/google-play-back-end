<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\IndexRequest;
use App\Http\Resources\Home\IndexAllAppsResource;
use App\Http\Resources\Home\IndexResource;
use App\Models\App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(IndexRequest $request)
    {
        $orders = [
            'rating',
            'size',
            'reviews',
            'installs',
            'price',
        ];

        $per_page = $request->per_page > 1 ? $request->per_page : 20;

        $sort  = in_array($request->orderby, $orders) ? $request->orderby : 'installs';
        $order = $request->order == 'ASC' ? 'ASC' : 'DESC';


        /** @var LengthAwarePaginator $all_apps */
        $all_apps = App::orderBy($sort, $order);

        //set search
        if (isset($request->search)) {
            $all_apps = $all_apps->where('name', 'like', '%'.$request->search.'%');
        }

        if (isset($request->filter, $request->filter_value)) {
            $filter_list = [
                'type',
                'genres',
                'category',
            ];

            if (in_array($request->filter, $filter_list)) {
                $all_apps = $all_apps->where($request->filter, $request->filter_value);
            }
        }


        $all_apps = $all_apps->paginate($per_page);

        $all_apps = IndexResource::collection($all_apps);


        //get categories and genres
        if ( ! Cache::has('index_categories')) {
            $categories = App::select('category')->groupBy('category')->get()->pluck('category');

            Cache::put('index_categories', $categories, 60 * 60); //1 Hour cache

        } else {
            $categories = Cache::get('index_categories');
        }

        //genres
        if ( ! Cache::has('index_genres')) {
            $genres = App::select('genres')->groupBy('genres')->get()->pluck('genres');

            Cache::put('index_genres', $genres, 60 * 60); //1 Hour cache

        } else {
            $genres = Cache::get('index_genres');
        }


        if ( ! Cache::has('index_best_apps')) {
            $best_apps = App::groupBy('name')->orderByRaw("(reviews/rating) DESC")->get()->take(10);
            $best_apps = IndexResource::collection($best_apps);

            Cache::put('index_best_apps', $best_apps, 60 * 60); //1 Hour cache
        } else {
            $best_apps = Cache::get('index_best_apps');
        }

        if ( ! Cache::has('index_most_download')) {
            $most_download = App::groupBy('name')->orderByRaw("length(installs) DESC")->get()->take(10);
            $most_download = IndexResource::collection($most_download);

            Cache::put('index_most_download', $most_download, 60 * 60); //1 Hour cache
        } else {
            $most_download = Cache::get('index_most_download');
        }


        return [
            'all_apps'      => $all_apps,
            'best_apps'     => $best_apps,
            'most_download' => $most_download,
            'categories'    => $categories,
            'genres'        => $genres
        ];
    }
}
