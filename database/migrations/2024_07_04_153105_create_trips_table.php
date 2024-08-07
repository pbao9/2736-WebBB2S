<?php

use App\Enums\Contract\ContractType;
use App\Enums\Session\Session;
use App\Enums\Trip\TripStatus;
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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('nany_id')->nullable();
            $table->string('code')->unique();
            $table->date('trip_date');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(TripStatus::Pending->value);
            $table->tinyInteger('session')->default(Session::Morning);
            $table->tinyInteger('type')->default(ContractType::DropOffOnly->value);
            $table->text('destination_photo')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->timestamp('time_arrived_at_school')->nullable();
            $table->text('current_address')->nullable();
            $table->double('current_lat', 10, 6)->nullable();
            $table->double('current_lng', 10, 6)->nullable();
            $table->timestamps();

            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
                ->onDelete('cascade');

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('set null');

            $table->foreign('nany_id')
                ->references('id')
                ->on('nannies')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
