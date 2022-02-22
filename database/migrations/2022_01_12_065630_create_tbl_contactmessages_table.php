<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContactmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contactmessages', function (Blueprint $table) {
               
                $table->bigIncrements('m_id');
                $table->string('m_name')->nullable(); 
                $table->string('m_email')->nullable(); 
                $table->longText('m_message')->nullable();   
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
        Schema::dropIfExists('tbl_contactmessages');
    }
}
