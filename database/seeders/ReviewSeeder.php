<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder {

    public function nanToZero( &$value ) {
        if ( strtolower( $value ) == "nan" ) {
            $value = '-1';
        }

        return $value;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $file = fopen( public_path( 'datasets/googleplaystore_user_reviews.csv' ), 'r' );

        while ( ! feof( $file ) ) {
            $line = fgetcsv( $file );

            $fileds = [
                'app',
                'translated_review',
                'sentiment',
                'sentiment_polarity',
                'sentiment_subjectivity',
            ];

            try {
                $values = array_combine( $fileds, $line );
                Review::create( $values );
            } catch ( \Exception $exception ) {
                echo $exception->getMessage();
            }

        }
        fclose( $file );
    }
}
