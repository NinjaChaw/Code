<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('title', 150);
            $table->string('duration', 30);
            $table->mediumInteger('slots_required')->unsigned();
            $table->mediumInteger('slots_taken')->unsigned()->default(0);
            $table->mediumInteger('slots_max')->unsigned();
            $table->decimal('start_balance', 12, 2);
            $table->integer('lot_size');
            $table->integer('leverage');
            $table->decimal('volume_min', 6, 2);
            $table->decimal('volume_max', 8, 2);
            $table->decimal('min_margin_level', 6, 2);
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            // indexes
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
