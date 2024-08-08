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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->integer('form_type')->default(0);
            $table->integer('type')->default(0);
            $table->string('name', 100)->nullable();
            $table->char('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('province_code')->nullable();
            $table->string('ward_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('location', 255)->nullable();
            $table->time('time_pickup')->nullable();
            $table->boolean('school_other')->nullable()->default(0);
            $table->integer('service')->nullable()->default(1);
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
};
