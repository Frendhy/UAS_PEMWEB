<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key is auto-incrementing
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->unsignedBigInteger('division_id')->nullable()->comment('References divisions table');
            $table->date('birthday')->nullable()->comment('User\'s birthday');
            $table->integer('role_id')->comment('1:admin, 2:member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
