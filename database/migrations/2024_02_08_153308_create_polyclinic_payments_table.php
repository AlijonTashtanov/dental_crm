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
        Schema::create('polyclinic_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('polyclinic_id')->nullable();
            $table->tinyInteger('type_id')->nullable();
            $table->integer('amount')->nullable();
            $table->string('comment', 1024)->nullable();
            $table->bigInteger('transaction_id')->nullable();
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
        Schema::dropIfExists('polyclinic_payments');
    }
};
