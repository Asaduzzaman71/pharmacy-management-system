<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->integer('medicine_id');
            $table->float('medicine_price_rate');
            $table->integer('medicine_quantity');
            $table->float('profit_amount');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('salesitems');
    }
}
