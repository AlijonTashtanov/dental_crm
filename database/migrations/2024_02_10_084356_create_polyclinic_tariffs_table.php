<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polyclinic_tariffs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tariff_id')->nullable()->unsigned()->index();
            $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
            $table->bigInteger('polyclinic_id')->nullable()->unsigned()->index();
            $table->foreign('polyclinic_id')->references('id')->on('polyclinics')->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->integer('max_doctor_count')->nullable();
            $table->integer('fee_for_one_doctor')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('polyclinic_tariffs');
    }
};
