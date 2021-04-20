<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articoli', function (Blueprint $table) {
            $table->id();
            $table->string('lean')->unique();
            $table->string('sku')->unique();
            $table->foreignId('tipologia_id')->constrained('tipologia');
            $table->foreignId('marca_id')->constrained('marca');
            $table->string('descrizione');
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
        Schema::dropIfExists('articoli');
    }
}
