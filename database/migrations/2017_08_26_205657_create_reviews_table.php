<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            // User ID who added the review.
            $table->integer('user_id')->unsigned()->index();
            // The attraction ID to which this review belongs.
            $table->integer('attraction_id')->unsigned()->index();
            // Rating for the attraction.
            $table->enum('rating', [1, 2, 3, 4, 5]);
            // Content of the review.
            $table->text('content')->nullable();
            // Visible / Hidden state of the review.
            $table->enum('visible', [0, 1])->default(1);
            $table->timestamps();

            // User can add only one review in attraction.
            $table->unique(['user_id', 'attraction_id']);

            //---------------------------------------------------------------------------------------------------------
            // Foreign keys
            //---------------------------------------------------------------------------------------------------------
            // Delete connected reviews with user deletion.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Delete connected reviews with attraction deletion.
            $table->foreign('attraction_id')->references('id')->on('attractions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
