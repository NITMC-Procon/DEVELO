<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropColumn('title');
            $table->dropColumn('intro');
            $table->dropColumn('intro_converted');
            $table->dropColumn('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->string('title');
            $table->integer('status')->unsigned()->default(0);
            $table->text('about')->nullable();
            $table->text('intro')->nullable();
            $table->text('intro_converted')->nullable();
        });
    }
};
