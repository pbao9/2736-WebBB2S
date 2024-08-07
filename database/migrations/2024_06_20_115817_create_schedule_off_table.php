<?php

use App\Enums\DefaultStatus;
use App\Enums\ScheduleOff\ScheduleOffType;
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
        Schema::create('schedule_off', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('nany_id')->nullable();
            $table->date('date_off');

            $table->tinyInteger('type')->default(ScheduleOffType::Private->value)->nullable();
            $table->integer('status')->default(DefaultStatus::Active->value);
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->nullOnDelete();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->nullOnDelete();
            $table->foreign('nany_id')->references('id')->on('nannies')->nullOnDelete();

            $table->string('note');
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
        Schema::dropIfExists('schedule_off');
    }
};
