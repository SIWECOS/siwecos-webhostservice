<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendUserTable extends Migration
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
                $table->tinyInteger('role')->index();
                $table->string('company', 255);
                $table->smallInteger('country')->unsigned();
                $table->string('telephone', 255);
                $table->boolean('approved')->default(0);
                $table->text('pgpkey');
                $table->string('invite_token', 32);
                $table->dateTime('invited_at');
                $table->integer('invited_by');
                $table->text('comment');
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
                $table->dropColumn('role');
                $table->dropColumn('company');
                $table->dropColumn('country');
                $table->dropColumn('telephone');
                $table->dropColumn('approved');
                $table->dropColumn('pgpkey');
                $table->dropColumn('invite_token');
                $table->dropColumn('invited_at');
                $table->dropColumn('invited_by');
                $table->dropColumn('comment');
            }
        );
    }
}
