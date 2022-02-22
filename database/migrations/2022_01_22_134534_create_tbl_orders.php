<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->uuid('o_id')->primary();
            $table->uuid('o_uid')->nullable();
            $table->string('o_fullname')->nullable(); 
            $table->string('o_address')->nullable(); 
            $table->string('o_phoneline')->nullable();
            $table->string('o_email')->nullable();
            $table->string('o_status')->default(0); 
            $table->longText('o_notes')->nullable();
            $table->integer('o_amount')->nullable();
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('tbl_orders');
    }
}
