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
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_id')->nullable();
                $table->string('first_name', 55);
                $table->string('last_name', 55);
                $table->char('cnic', 50)->nullable();
                $table->string('email', 255)->unique();
                $table->string('password', 255);
                $table->string('profile_picture', 100)->nullable();
                $table->text('profile_detail')->nullable();
                $table->bigInteger('contact')->nullable();
                $table->string('verification_token', 255)->nullable();
                $table->string('remember_token', 255)->nullable();
                $table->tinyInteger('is_block')->default(0);
                $table->tinyInteger('is_verified')->default(0);
                $table->integer('created_by')->nullable()->default(0);
                $table->integer('updated_by')->nullable()->default(0);
                $table->timestamps();
            });
        }
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
