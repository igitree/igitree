<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_requests', function (Blueprint $table) {
        
            $table->uuid('id')->primary(); 
            $table->uuid('family_id');
            $table->string('user_requested')->nullable();
            $table->longText('info')->nullable();
            $table->string('accepted')->default(0);
            $table->string('relation')->nullable();
            $table->string('to')->nullable();
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
        Schema::dropIfExists('family_requests');
    }
}
