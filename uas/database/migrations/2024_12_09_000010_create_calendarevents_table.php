<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendareventsTable extends Migration
{
    public function up()
    {
        Schema::create('calendarevents', function (Blueprint $table) {
            $table->id('event_id');
            $table->date('event_date');
            $table->string('event_title', 255);
            $table->text('event_description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            
            $table->unique(['event_date', 'event_id', 'event_title']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendarevents');
    }
}
