<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->uuid('u_id')->primary();
            $table->string('u_fullname');     
             $table->string('u_dob')->nullable();    
             $table->string('u_address')->nullable();  
             $table->string('u_email')->nullable(); 
             $table->string('u_password')->nullable();     
             $table->string('u_phoneline')->nullable(); 
             $table->string('u_gender')->nullable();  
             $table->string('u_country')->nullable();              
             $table->string('u_verification_code')->nullable();    
             $table->string('u_status')->nullable(); 
             $table->string('active_status')->nullable()->default(1);
             $table->string('oauth_type')->nullable();
             $table->string('oauth_id')->nullable(); 
             $table->string('remember_token')->nullable();
             $table->text('two_factor_secret')->nullable(); 
             $table->text('two_factor_recovery_codes')->nullable();
             $table->string('profile_photo_path')->nullable();
           
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
        Schema::dropIfExists('tbl_users');
    }
}
