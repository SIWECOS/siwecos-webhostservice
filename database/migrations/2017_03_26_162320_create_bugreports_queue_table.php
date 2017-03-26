<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugreportsQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create(
		    'bugreports_queue',
		    function (Blueprint $table) {
			    $table->integer('bugreport_id');
			    $table->integer('user_id');
			    $table->tinyInteger('priority');
		    }
	    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('bugreports_queue');
    }
}
