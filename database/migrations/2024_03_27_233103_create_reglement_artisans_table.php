<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglement_artisans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->constrained('artisans');
            $table->foreignId('mode_id')->constrained('modes');
            $table->date('date');
            $table->string('montant ');
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
        Schema::dropIfExists('reglement_artisans');
    }
};
