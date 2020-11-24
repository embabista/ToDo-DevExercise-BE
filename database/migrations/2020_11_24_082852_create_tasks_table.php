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
            //
            $table->bigIncrements('id');
            $table->string('task');
            $table->foreignId('user_id');
            $table->boolean('done')->default(false);
            $table->foreignId('list_id')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('reminder')->nullable();
            $table->dateTime('due_date')->nullable();
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
