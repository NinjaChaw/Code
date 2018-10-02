<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            // columns
            $table->increments('id');
            $table->string('symbol', 30)->unique();
            $table->string('name', 150);
            $table->tinyInteger('status');
            $table->string('logo', 100)->nullable();
            $table->decimal('price', 20, 8)->default(0);
            $table->decimal('change_abs', 20, 8)->default(0);
            $table->decimal('change_pct', 12, 2)->default(0);
            $table->bigInteger('supply')->default(0);
            $table->bigInteger('volume')->default(0);
            $table->bigInteger('market_cap')->default(0);
            $table->timestamps();
            // indexes
            $table->index('name');
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
        Schema::dropIfExists('assets');
    }
}
