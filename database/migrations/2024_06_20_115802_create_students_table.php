<?php

use App\Enums\Student\StudentGrade;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('name_other')->nullable();
            $table->string('phone_other')->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('grade')->default(StudentGrade::Grade1);
            $table->string('grade_detail');

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
        Schema::dropIfExists('students');
    }
};
