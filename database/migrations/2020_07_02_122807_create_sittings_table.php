<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSittingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sittings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('start_hour');
            $table->string('end_hour');
            $table->integer('day');
            $table->text('description');
            
            $table->index('teacher_id');
            $table->unsignedBigInteger('teacher_id')->nullable(false);
            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
                  ->onDelete('cascade');
            
            $table->index('classe_id');
            $table->unsignedBigInteger('classe_id')->nullable(false);
            $table->foreign('classe_id')
                  ->references('id')->on('class_rooms')
                  ->onDelete('cascade');
            
               $table->index('course_id');
            $table->unsignedBigInteger('course_id')->nullable(false);
            $table->foreign('course_id')
                  ->references('id')->on('courses')
                  ->onDelete('cascade');
            
            $table->index('school_year_id');
            $table->unsignedBigInteger('school_year_id')->nullable(false);
            $table->foreign('school_year_id')
                  ->references('id')->on('school_years')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('sittings');
    }
}
