<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->tinyInteger('role')->nullable();
                $table->string('company')->nullable();
                $table->smallInteger('country')->nullable();
                $table->string('telephone')->nullable();
                $table->text('pgpkey')->nullable();
                $table->dropColumn('invite_token');
                $table->dropColumn('invited_by');
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
        //
    }
}
