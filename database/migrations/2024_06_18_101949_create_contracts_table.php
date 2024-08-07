<?php

use App\Enums\Contract\ContractStatus;
use App\Enums\Contract\ContractType;
use App\Enums\Session\Session;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('old_expired_at')->nullable();
            $table->json('schedule')->nullable();
            $table->tinyInteger('type')->default(ContractType::PickUpOnly->value);
            $table->tinyInteger('status')->default(ContractStatus::Draft);

            $table->tinyInteger('session_arrive_school')->default(Session::Morning)->nullable();
            $table->time('time_arrive_school')->nullable();
            $table->tinyInteger('session_off')->default(Session::Afternoon)->nullable();
            $table->time('time_off')->nullable();

            $table->unsignedBigInteger('nany_id');
            $table->foreign('nany_id')->references('id')->on('nannies')->onDelete('cascade');

            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

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
        Schema::dropIfExists('contracts');
    }
};
