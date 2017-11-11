<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodicreminderColumnsToUsersTable extends Migration
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
                $table->dateTime('last_reminder')->nullable();
                $table->integer('last_reminder_confirmed')->unsigned()->nullable();
                $table->string('last_reminder_token', 191)->nullable();
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
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->dropColumn('last_reminder');
                $table->dropColumn('last_reminder_confirmed');
                $table->dropColumn('last_reminder_token');
            }
        );
    }
}
