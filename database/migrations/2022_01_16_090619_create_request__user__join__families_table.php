<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestUserJoinFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request__user__join__families', function (Blueprint $table) {
            $table->uuid('id')->primary();
              $table->uuid('family_id');
              $table->uuid('request_sent_by')->nullable();
            $table->string('user_requested')->nullable(); 
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
        Schema::dropIfExists('request__user__join__families');
    }
}
