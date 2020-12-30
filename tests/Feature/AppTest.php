<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetApp()
    {
        $app_name = "10 Best Foods for You";
        $response = $this->get('/api/reviews/'.$app_name);

        $response->assertJsonStructure([
            'app'     => [
                'id',
                'name',
                'category',
                'rating',
                'reviews',
                'size',
                'installs',
                'type',
                'price',
                'content_rating',
                'genres',
                'last_updated',
                'current_version',
                'android_version',
            ],
            'reviews' => [
                [
                    'content',
                    'sentiment',
                    'sentiment_polarity',
                    'sentiment_subjectivity',
                ]
            ]
        ]);
    }


    public function testAppNotFound()
    {
        $fake_app_name = "not exist App";
        $response = $this->get('/api/reviews/'. $fake_app_name);

        $response->assertStatus(404);
    }
}
