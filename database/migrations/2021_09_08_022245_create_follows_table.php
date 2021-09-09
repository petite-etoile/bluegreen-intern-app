<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger('following_user_id')->comment("フォローした人のID");
            $table->unsignedBigInteger('followed_user_id')->comment("フォローされた人のID");
            $table->timestamps();

            $table->primary(['following_user_id', 'followed_user_id']);

            $table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
