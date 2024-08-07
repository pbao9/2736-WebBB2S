<?php

use App\Enums\Trip\PickupStatus;
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
        Schema::create('trip_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('picked_up')->default(PickupStatus::NotPickedToSchool->value);
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->text('student_image')->nullable();
            $table->text('skip_reason')->nullable();
            $table->foreign('trip_id')->references('id')
                ->on('trips')
                ->onDelete('cascade');
            $table->foreign('student_id')->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_details');
    }
};
