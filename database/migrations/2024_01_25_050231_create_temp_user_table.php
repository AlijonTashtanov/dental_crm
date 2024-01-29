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
        Schema::create('temp_users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('username')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('address', 1024)->nullable();
            $table->string('password_hash')->nullable();
            $table->integer('code')->nullable();
            $table->integer('expired_at')->nullable();
            $table->boolean('is_verified')->default(false)->nullable();
            $table->boolean('is_registered')->default(false)->nullable();
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
        Schema::dropIfExists('temp_users');
    }
};
