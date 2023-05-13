<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('masv')->default(0);
            $table->text('name');
            $table->text('imageLink');
            $table->bigInteger('classId');
            $table->bigInteger('teacherId');
            $table->boolean('check');
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
        Schema::dropIfExists('check_days');
    }
}
