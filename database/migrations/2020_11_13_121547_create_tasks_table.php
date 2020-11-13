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
            $table->unsignedBigInteger('action_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('document_id')->nullable();
            $table->unsignedBigInteger('enduser_id')->nullable();
            // formerly particulars
            $table->text('details')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('action_id')->references('id')->on('actions')->onDelete('set null');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('set null');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
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
