<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Product\ProductStatus;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('image');
            $table->tinyInteger('status')->default(ProductStatus::class::Draft->value);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('title_seo', 255)->nullable();
            $table->string('desc_seo', 255)->nullable();
            $table->unsignedBigInteger('viewed')->nullable();
            $table->tinyInteger('post_type');
            $table->dateTime('posted_at');
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
        Schema::dropIfExists('products');
    }
};
