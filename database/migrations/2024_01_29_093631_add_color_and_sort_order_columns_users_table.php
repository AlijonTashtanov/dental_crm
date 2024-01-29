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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('percent_treatment')->nullable()->comment("Davolashdan oladigan ulushi");
            $table->string('color')->nullable()->comment("Xodim rangi");
            $table->bigInteger('sort_order')->nullable()->comment("Xodim tartib raqami")->default(999999999);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('percent_treatment');
            $table->dropColumn('color');
            $table->dropColumn('sort_order');
        });
    }
};
