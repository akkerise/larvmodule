<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateH5MigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h5_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('h5_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appota_user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('h5_roles')->onDelete('cascade');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('fullname');
            $table->string('birthday');
            $table->string('mobile');
            $table->string('address');
            $table->string('avatar');
            $table->tinyInteger('gender');
            $table->string('register_date')->nullable();
            $table->string('register_ip')->nullable();
            $table->string('last_activity')->nullable();
            $table->tinyInteger('is_moderator')->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->tinyInteger('is_banned')->nullable();
            $table->tinyInteger('status');
            $table->string('access_token')->nullable();
            $table->string('refresh_token');
            $table->string('remember_token');
            $table->string('expired_at');
            $table->timestamps();
        });

        Schema::create('h5_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('order');
            $table->integer('status');
            $table->integer('parent_id');
            $table->string('parent_slug');
            $table->string('description');
            $table->string('cover');
            $table->string('icon');
            $table->timestamps();
        });

        Schema::create('h5_games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('logo');
            $table->string('cover');
            $table->string('thumb_share');
            $table->string('link');
            $table->string('description');
            $table->string('publish_at');
            $table->tinyInteger('status');
            $table->integer('viewed');
            $table->integer('played');
            $table->tinyInteger('is_trending');
            $table->tinyInteger('is_ghim');
            $table->string('tags');
//            $table->integer('tag_id')->unsigned();
//            $table->foreign('tag_id')->references('id')->on('h5_game_tag')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('h5_users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('h5_categories')->onDelete('cascade');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('h5_game_track_play', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('h5_users')->onDelete('cascade');
            $table->string('ip_address');
            $table->string('device_os');
            $table->string('device_name');
            $table->string('os_version');
            $table->string('model_name');
            $table->timestamps();
        });

        Schema::create('h5_game_track_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('h5_users')->onDelete('cascade');
            $table->integer('score');
            $table->string('ip_address');
            $table->string('device_os');
            $table->string('device_name');
            $table->string('os_version');
            $table->string('model_name');
            $table->timestamps();
        });

        Schema::create('h5_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('h5_game_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('h5_tags')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('h5_game_track_view', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->string('ip_address');
            $table->string('device_os');
            $table->string('device_name');
            $table->string('os_version');
            $table->string('model_name');
            $table->timestamps();
        });

        Schema::create('h5_game_config_turn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('h5_users')->onDelete('cascade');
            $table->integer('turn');
            $table->string('expired_at');
            $table->timestamps();
        });

        Schema::create('h5_accumulation_point', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('h5_users')->onDelete('cascade');
            $table->integer('point');
            $table->timestamps();
        });

        Schema::create('h5_config_score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('h5_games')->onDelete('cascade');
            $table->integer('score');
            $table->string('expired_at');
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
        Schema::dropIfExists('h5_users');
        Schema::dropIfExists('h5_categories');
        Schema::dropIfExists('h5_games');
        Schema::dropIfExists('h5_game_track_play');
        Schema::dropIfExists('h5_game_track_score');
        Schema::dropIfExists('h5_tags');
        Schema::dropIfExists('h5_game_tag');
        Schema::dropIfExists('h5_game_track_view');
        Schema::dropIfExists('h5_game_config_turn');
        Schema::dropIfExists('h5_accumulation_point');
        Schema::dropIfExists('h5_config_score');
    }
}
