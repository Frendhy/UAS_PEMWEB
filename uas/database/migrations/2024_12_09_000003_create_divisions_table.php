<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id(); 
            $table->string('divisi_name', 100)->unique();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
