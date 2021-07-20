<?php

use App\Models\DiscountCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('client_id');
            $table->string('code');
            $table->tinyInteger('status')->default(DiscountCode::STATUS_ACTIVE);

            $table->timestamps();

            $table->foreign('discount_id')->references('id')->on('discounts')
                ->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('discount_codes');
    }
}
