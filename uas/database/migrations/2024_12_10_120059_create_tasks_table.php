<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['done', 'in_progress', 'not_yet']);
        $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade'); 
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
