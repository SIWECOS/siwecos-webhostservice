<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExploidtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('exploidtypes', function (Blueprint $table) {
		    $table->increments('id')->index();
		    $table->string('exploidtype', 100);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	     Schema::dropIfExists('exploidtypes');
    }
}
