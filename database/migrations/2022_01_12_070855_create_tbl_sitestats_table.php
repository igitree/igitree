<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSitestatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sitestats', function (Blueprint $table) {
          
                $table->bigIncrements('ss_id');
                $table->string('ss_page')->nullable(); 
                $table->string('ss_ipAddress')->nullable(); 
                $table->string('ss_userAgent')->nullable(); 
                $table->string('ss_browser')->nullable(); 
                $table->string('ss_browserVersion')->nullable(); 
                $table->string('ss_osType')->nullable();
                $table->string('ss_deviceType')->nullable(); 
                $table->string('ss_date')->nullable(); 
                $table->string('ss_status')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sitestats');
    }
}
