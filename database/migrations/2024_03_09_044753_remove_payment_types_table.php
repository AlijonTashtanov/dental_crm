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
        Schema::dropIfExists('payment_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('icon')->nullable();
            $table->bigInteger('polyclinic_id')->nullable();
            $table->string('color')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }
};
