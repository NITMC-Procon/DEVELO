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
        Schema::create('project_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignID('project_id')->constrained();
            $table->string('title');
            $table->integer('status')->unsigned()->default(0);
            $table->text('about')->nullable();
            $table->text('intro')->nullable();
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
        Schema::dropIfExists('project_contents');
    }
};
