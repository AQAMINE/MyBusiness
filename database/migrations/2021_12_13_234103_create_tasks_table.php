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
            $table->string('taskTitle'); //Task Title
            $table->text('task'); //Task Content
            $table->boolean('done')->default(0); //Task Done Or Not (0 Not Yet AND 1 Done)
            $table->integer('doneBy')->nullable(); //Done By User
            $table->integer('privacy')->default(0); //Can All Users Doing It (1.2....userid: For Specific User  AND 0 Public Task)
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
