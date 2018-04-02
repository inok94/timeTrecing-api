<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeсlientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeeсlients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->nullable()->unsigned();
            $table->integer('client_id')->nullable()->unsigned();
            $table->date('date');
            $table->time('started_work');
            $table->time('finished_work');

            $table->foreign('employee_id')
                ->references('id')->on('users');

            $table->foreign('client_id')
                ->references('id')->on('clients');

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
        Schema::dropIfExists('employeeсlients');
    }
}
