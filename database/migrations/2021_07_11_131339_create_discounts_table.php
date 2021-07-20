<?php

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('amount');
            $table->tinyInteger('trigger')->default(Discount::TRIGGER_VISIT);
            $table->dateTime('start_date')->default(Carbon::now());
            $table->dateTime('end_date')->default(Carbon::now()->addDay());
            $table->integer('code_active_days')->default(Discount::CODE_ACTIVE_DAYS_DEFAULT);
            $table->integer('available_code_count')->default(Discount::AVAILABLE_CODE_COUNT);
            $table->integer('status')->default(Discount::STATUS_ACTIVE);

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
        Schema::dropIfExists('discounts');
    }
}
