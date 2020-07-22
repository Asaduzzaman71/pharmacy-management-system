<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('medicine_name');
            $table->string('medicine_code');
            $table->string('company_name');
            $table->integer('medicine_category_id');
            $table->float('purchase_price');
            $table->float('selling_price');
            $table->string('storing_area')->nullable();
            $table->integer('quantity');
            $table->string('generic_name');
            $table->string('medicine_class')->nullable();
            $table->string('effects')->nullable();
            $table->string('expire_date');
            $table->string('adding_date');
            $table->tinyInteger('status');
            $table->string('created_by');
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
        Schema::dropIfExists('medicines');
    }
}
