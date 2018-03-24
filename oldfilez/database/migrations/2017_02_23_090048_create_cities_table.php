<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('cities_jobs', function (Blueprint $table) {
            $table->integer('jobs_id');
            $table->integer('cities_id');
            $table->primary('jobs_id','cities_id');
        });

        Schema::create('cities_resumes', function (Blueprint $table) {
            $table->integer('resumes_id');
            $table->integer('cities_id');
            $table->primary('resumes_id','cities_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities');
    }
}
