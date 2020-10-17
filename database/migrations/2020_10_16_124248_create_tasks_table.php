<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('media_id');
            $table->unsignedBigInteger('status_id')->default(1);

            $table->foreign('board_id')->on('boards')->references('id')->onDelete('cascade');
            $table->foreign('media_id')->on('media')->references('id')->onDelete('cascade');
            $table->foreign('status_id')->on('task_statuses')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('tasks');
    }
}
