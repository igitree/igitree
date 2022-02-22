<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_logins', function (Blueprint $table) {
         
            $table->bigIncrements('login_id');
                $table->string('login_user')->nullable(); 
                $table->string('login_ipAddress')->nullable(); 
                 $table->string('login_userAgent')->nullable(); 
                $table->string('login_osType')->nullable(); 
                $table->string('login_deviceType')->nullable(); 
                $table->string('login_date')->nullable();
                $table->string('login_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_logins');
    }
}
