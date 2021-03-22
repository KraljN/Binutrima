<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('username', 25)->unique();
            $table->string('email', 25);
            $table->string('password', 200);
            $table->bigInteger('role_id')->unsigned();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
