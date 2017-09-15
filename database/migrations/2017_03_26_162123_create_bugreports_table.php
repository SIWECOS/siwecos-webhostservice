<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugreports', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_id');
            $table->dateTime('date', 191);
            $table->tinyInteger('sent');
            $table->integer('application');
            $table->integer('exploidtypes');
            $table->string('version', 100);
            $table->text('signed-email');
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
        Schema::dropIfExists('bugreports');
    }
}
