<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'reviews', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'app' );
            $table->text( 'translated_review' );
            $table->string( 'sentiment' );
            $table->string( 'sentiment_polarity' );
            $table->string( 'sentiment_subjectivity' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'app_reviews' );
    }
}
