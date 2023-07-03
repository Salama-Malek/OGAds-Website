<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCodeColumnInCodesTable extends Migration
{
    public function up()
    {
        Schema::table('codes', function (Blueprint $table) {
            $table->bigInteger('code')->change();
        });
    }

    public function down()
    {
        Schema::table('codes', function (Blueprint $table) {
            $table->integer('code')->change();
        });
    }
}
