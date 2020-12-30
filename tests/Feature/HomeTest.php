<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomeStructure()
    {
        $response = $this->get('/api');

        //test json structure
        $response->assertJsonStructure([
            "all_apps" => [
                [
                    "id",
                    "name",
                    "category",
                    "rating",
                    "reviews",
                    "size",
                    "installs",
                    "type",
                    "price",
                    "content_rating",
                    "genres",
                    "last_updated",
                    "current_version",
                    "android_version"
                ]
            ],
            "best_apps",
            "most_download",
            "categories",
            "genres"
        ]);
    }

    /**
     * @return void
     */
    public function testFilter()
    {
        $per_page = 20;
        $category = "ART_AND_DESIGN";
        $response = $this->get('/api?per_page='.$per_page.'&filter=category&filter_value='.$category);

        $category_array = [];
        for ($i = 0; $i < $per_page; $i++) {
            $category_array[] = $category;
        }

        $response->assertJsonPath('all_apps.*.category', $category_array);
    }


}
