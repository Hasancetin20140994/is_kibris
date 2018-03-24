<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('jobs_types', function (Blueprint $table) {
            $table->integer('jobs_id');
            $table->integer('types_id');
            $table->primary('jobs_id','types_id');
        });

        Schema::create('resumes_types', function (Blueprint $table) {
            $table->integer('resumes_id');
            $table->integer('types_id');
            $table->primary('resumes_id','types_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('types');
    }
}
