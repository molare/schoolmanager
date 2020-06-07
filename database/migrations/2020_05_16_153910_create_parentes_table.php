<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('active')->nullable(false);
            $table->string('phone');
            $table->string('cel');
            $table->string('email');
            $table->string('adresse')->nullable(true);
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
        Schema::dropIfExists('parentes');
    }
}
