<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrPrasTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_pras_task', function (Blueprint $table) {
            $table->unsignedBigInteger('pr_pras_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->foreign('pr_pras_id')->references('id')->on('pr_pras')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_pras_task');
    }
}
