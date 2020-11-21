<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder {


    public function nanToZero( $value ) {
        if ( strtolower( $value ) == "nan" ) {
            $value = 0;
        }

        return $value;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $file = fopen( public_path( 'datasets/googleplaystore.csv' ), 'r' );

        while ( ! feof( $file ) ) {
            $line   = fgetcsv( $file );
            $line   = array_map( [ $this, 'nanToZero' ], $line );
            $fileds = [
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
            ];

            try {
                $values = array_combine( $fileds, $line );
                App::create( $values );
            } catch ( \Exception $exception ) {

            }

        }
        fclose( $file );
    }
}
