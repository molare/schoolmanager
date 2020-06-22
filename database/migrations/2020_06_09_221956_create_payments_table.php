<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_payment');
            $table->double('amount');
            $table->text('description');
            
            $table->index('student_id');
            $table->unsignedBigInteger('student_id')->nullable(false);
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
            
            $table->index('payment_type_id');
            $table->unsignedBigInteger('payment_type_id')->nullable(false);
            $table->foreign('payment_type_id')
                  ->references('id')->on('payment_types')
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
        Schema::dropIfExists('payments');
    }
}
