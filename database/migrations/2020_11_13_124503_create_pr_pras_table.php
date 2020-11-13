<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrPrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_pras', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('details');
            $table->unsignedBigInteger('enduser_id')->nullable();
            $table->timestamps();

            $table->foreign('enduser_id')->references('id')->on('endusers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_pras');
    }
}
