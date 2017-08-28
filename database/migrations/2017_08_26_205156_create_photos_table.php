<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            // The attraction ID to which this photo belongs.
            $table->integer('attraction_id')->unsigned()->index();
            // User ID who added the attraction.
            $table->integer('user_id')->unsigned()->index();
            // Path to the file in the storage.
            $table->string('path');
            $table->timestamps();

            //---------------------------------------------------------------------------------------------------------
            // Foreign keys
            //---------------------------------------------------------------------------------------------------------
            // Delete connected photos with attraction deletion.
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
        Schema::dropIfExists('photos');
    }
}
