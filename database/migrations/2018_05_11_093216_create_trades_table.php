<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('competition_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('asset_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->tinyInteger('direction');
            $table->integer('lot_size');
            $table->decimal('volume', 8, 2);
            $table->decimal('price_open', 20, 8);
            $table->decimal('price_close', 20, 8)->nullable();
            $table->decimal('margin', 10, 2);
            $table->decimal('pnl', 14, 2)->default(0);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->dateTime('closed_at')->nullable();
            // foreign keys
            $table->foreign('competition_id')->references('id')->on('competitions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            // indexes
            $table->index('status');
            $table->index('pnl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
