<?php

use App\Enums\Driver\DriverStatus;
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
        Schema::create('nannies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('id_card_date')->nullable();
            $table->char('id_card', 50)->nullable()->unique();
            $table->string('id_card_front')->nullable();
            $table->string('id_card_back')->nullable();
            $table->text('current_address')->nullable();
            $table->double('current_lat', 10, 6)->nullable();
            $table->double('current_lng', 10, 6)->nullable();

            $table->string('bank_name')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->char('bank_account_number')->nullable();
            $table->tinyInteger('order_accepted')->default(DriverStatus::Active->value);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('nannies');
    }
};
