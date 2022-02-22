<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chats', function (Blueprint $table) {
            $table->uuid('c_id')->primary(); 
            $table->uuid('c_sender');
            $table->uuid('c_recipient');
            $table->longText('c_message')->nullable();
            $table->string('c_image')->nullable();
            $table->string('c_date')->nullable();
            $table->string('c_device')->nullable();
            $table->string('c_os_type')->nullable();
            $table->string('c_status')->default(0);
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
        Schema::dropIfExists('tbl_chats');
    }
}
