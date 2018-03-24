<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('category_jobs', function (Blueprint $table) {
            $table->integer('jobs_id');
            $table->integer('category_id');
            $table->primary('jobs_id','category_id');
        });

        Schema::create('category_resumes', function (Blueprint $table) {
            $table->integer('resumes_id');
            $table->integer('category_id');
            $table->primary('resumes_id','category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');

        Schema::drop('category_jobs');
    }
}
