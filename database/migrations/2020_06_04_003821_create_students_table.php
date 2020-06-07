<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('cel');
            $table->string('email');
            $table->string('birth_date');
            $table->integer('pay_status');
            $table->integer('active');
            $table->string('adresse')->nullable(true);
            $table->string('register_number');
            
            $table->index('parente_id');
            $table->unsignedBigInteger('parente_id')->nullable(false);
            $table->foreign('parente_id')
                  ->references('id')->on('parentes')
                  ->onDelete('cascade');
            
            $table->index('classe_id');
            $table->unsignedBigInteger('classe_id')->nullable(false);
            $table->foreign('classe_id')
                  ->references('id')->on('class_rooms')
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
        Schema::dropIfExists('students');
    }
}
