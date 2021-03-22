<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_ratings', function (Blueprint $table) {
            $table->id();
            $table->boolean('rating_index');
            $table->timestamps();
            $table->bigInteger('comment_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_ratings');
    }
}
