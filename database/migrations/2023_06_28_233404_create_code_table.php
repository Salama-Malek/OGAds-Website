<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTable extends Migration
{
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
