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
            $table->id();
            $table->string('name', 10)->comment("ユーザ名");
            $table->string('email')->unique()->comment("メールアドレス");
            $table->timestamp('email_verified_at')->nullable()->comment("メール登録日時");
            $table->string('password')->comment("パスワード");
            $table->string('introduction')->nullable()->comment("自己紹介文");
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
