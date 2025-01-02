<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id'); // Referensi ke tabel task
            $table->unsignedBigInteger('user_id'); // Referensi ke tabel user
            $table->text('comment'); // Isi komentar
            $table->string('file_path')->nullable(); // Lokasi file yang diupload
            $table->timestamps();

            // Foreign keys
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_comments');
    }
}
