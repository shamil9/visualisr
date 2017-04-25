<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('twitter_id')->nullable();
            $table->string('name', 150)->unique();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('avatar')->default('user.svg');
            $table->boolean('banned')->default(0);
            $table->boolean('admin')->default(0);
            $table->string('twitter_profile_background_color')->nullable();
            $table->string('twitter_profile_link_color')->nullable();
            $table->string('twitter_profile_image_url')->nullable();
            $table->string('twitter_avatar')->nullable();
            $table->rememberToken();
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
