<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_participants', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->integer('competition_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('start_balance', 12, 2);
            $table->decimal('current_balance', 12, 2);
            $table->integer('place')->nullable();
            $table->timestamps();
            // foreign keys
            $table->foreign('competition_id')->references('id')->on('competitions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // indexes
            $table->unique(['competition_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_participants');
    }
}
