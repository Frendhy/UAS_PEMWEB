<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHmifmembersTable extends Migration
{
    public function up()
    {
        Schema::create('hmifmembers', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('full_name', 100);
            $table->string('role', 50)->nullable();
            $table->string('contact_email', 100)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hmifmembers');
    }
}
