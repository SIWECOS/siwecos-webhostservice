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
                $table->string('company', 191)->default('');
                $table->smallInteger('country')->unsigned()->default(0);
                $table->string('telephone', 191)->default('');
                $table->boolean('approved')->default(0);
                $table->text('pgpkey')->nullable();
                $table->integer('invited_by')->unsigned()->nullable();
                $table->dateTime('invited_at')->nullable();
                $table->text('invite_reason');
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
                $table->dropColumn('invited_at');
                $table->dropColumn('invited_by');
                $table->dropColumn('invite_reason');
                $table->dropColumn('comment');
            }
        );
    }
}
