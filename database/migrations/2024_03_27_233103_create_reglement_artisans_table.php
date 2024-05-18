<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementArtisansTable extends Migration
{
    public function up()
    {
        Schema::create('reglement_artisans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('artisan_id')->unsigned();
            $table->bigInteger('mode_id')->unsigned();
            $table->foreignId('artisan_id')->constrained('artisans');
            $table->foreignId('mode_id')->constrained('modes');
            $table->date('date');
            $table->decimal('montant', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reglement_artisans');
    }
}
