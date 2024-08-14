<?php

use App\Enums\Product\ProductBanner;
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
            $table->text('banner_title')->nullable();
            $table->text('banner')->nullable();
            $table->boolean('show_banner')->default(ProductBanner::class::Off->value);
            $table->tinyInteger('status')->default(ProductStatus::class::Draft->value);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('title_seo', 255)->nullable();
            $table->string('desc_seo', 255)->nullable();
            $table->unsignedBigInteger('viewed')->nullable();
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
