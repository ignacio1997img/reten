<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id')->nullable()->constrained('fees');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicle_types');
            $table->decimal('price', 10, 2)->nullable();
            $table->text('detail')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_vehicles');
    }
}
