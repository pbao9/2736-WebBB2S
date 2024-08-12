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
        Schema::table('contact', function (Blueprint $table) {
            $table->string('session_arrive_school')->nullable();
            $table->string('time_arrive_school')->nullable();
            $table->string('session_off')->nullable();
            $table->string('time_off')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn(['session_arrive_school', 'time_arrive_school', 'session_off', 'time_off']);
        });
    }
};
