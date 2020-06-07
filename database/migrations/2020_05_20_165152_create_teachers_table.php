<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('cel');
            $table->string('email');
            $table->integer('active');
            $table->string('adresse')->nullable(true);
            $table->index('category_id');
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
            $table->index('genre_id');
            $table->unsignedBigInteger('genre_id')->nullable(false);
            $table->foreign('genre_id')
                  ->references('id')->on('genres')
                  ->onDelete('cascade');
            
             $table->index('school_year_id');
            $table->unsignedBigInteger('school_year_id')->nullable(false);
            $table->foreign('school_year_id')
                  ->references('id')->on('school_years')
                  ->onDelete('cascade');
            
            $table->string('photo')->nullable(true);
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
        Schema::dropIfExists('teachers');
    }
}
