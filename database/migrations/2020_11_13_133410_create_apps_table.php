<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'apps', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' )->unique();
            $table->string( 'category' );
            $table->double( 'rating' );
            $table->integer( 'reviews' );
            $table->string( 'size', 6 );
            $table->string( 'installs' );
            $table->string('type', 6);
            $table->string('price', 6);
            $table->string('content_rating');
            $table->string('genres');
            $table->string('last_updated');
            $table->string('current_version');
            $table->string('android_version');
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'apps' );
    }
}