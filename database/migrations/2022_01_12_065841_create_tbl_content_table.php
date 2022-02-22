<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_content', function (Blueprint $table) {
              $table->bigIncrements('c_id');
                $table->longText('c_content')->nullable(); 
                $table->longText('c_type')->nullable(); 
                $table->longText('c_title')->nullable(); 
                $table->string('c_image')->nullable(); 
                $table->string('c_added_at')->nullable();
                $table->string('c_added_by')->nullable();
                $table->string('c_last_edited_at')->nullable();
                $table->string('c_last_edited_by')->nullable();
                $table->string('c_status')->nullable();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_content');
    }
}
