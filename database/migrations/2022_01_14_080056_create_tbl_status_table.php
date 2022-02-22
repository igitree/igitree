<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_status', function (Blueprint $table) {
           $table->uuid('s_id')->primary(); 
            $table->uuid('user_id'); 
            $table->uuid('family_id');
            $table->string('s_image')->nullable();
            $table->longText('s_text')->nullable();
            $table->string('s_video')->nullable();
            $table->string('views')->default(0);
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
        Schema::dropIfExists('tbl_status');
    }
}
