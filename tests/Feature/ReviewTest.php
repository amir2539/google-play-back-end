<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDataError()
    {
        //make an request with insufficient post data
        $post_data = [
            'app'    => 'new app',
            'review' => 'new review'
        ];


        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/reviews/add', $post_data);

        $response->assertStatus(422);
    }


    public function testAddReview()
    {
        //make an request with insufficient post data
        $post_data = [
            "app"                    => "pou",
            "review"                 => "new review",
            "sentiment"              => "positive",
            "sentiment_subjectivity" => "1",
            "sentiment_polarity"     => "1"
        ];


        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/reviews/add', $post_data);

        $response->assertStatus(200)->assertExactJson([
            'review' => [
                'app' => $post_data['app'],
                'review' => $post_data['review'],
                'sentiment' => $post_data['sentiment'],
                'sentiment_subjectivity' => $post_data['sentiment_subjectivity'],
                'sentiment_polarity' => $post_data['sentiment_polarity'],
            ]
        ]);
    }

}
