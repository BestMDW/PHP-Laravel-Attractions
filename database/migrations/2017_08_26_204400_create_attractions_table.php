<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->increments('id');
            // User ID who added the attraction.
            $table->integer('user_id')->unsigned()->index();
            // Name of the attraction.
            $table->string('name');
            // Description of the attraction.
            $table->text('body');
            $table->timestamps();

            //---------------------------------------------------------------------------------------------------------
            // Foreign keys
            //---------------------------------------------------------------------------------------------------------
            // Delete connected attractions with user deletion.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attractions');
    }
}
