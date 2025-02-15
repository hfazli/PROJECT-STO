<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWipsTable extends Migration
{
    public function up()
    {
        Schema::create('wips', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id');
            $table->string('part_name');
            $table->string('part_number');
            $table->string('type_package');
            $table->integer('qty_package')->default(0); // Add default value if needed
            $table->string('project')->nullable();
            $table->string('customer');
            $table->string('detail_lokasi')->nullable();
            $table->string('satuan');
            $table->integer('stok_awal')->default(0); // Add new column
            $table->string('plant'); // Add new column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wip');
    }
}