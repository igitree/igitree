<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_team', function (Blueprint $table) {
               
                 $table->bigIncrements('t_id');
                $table->string('t_name')->nullable(); 
                $table->string('t_position')->nullable(); 
                $table->string('t_contacts')->nullable(); 
                $table->string('t_email')->nullable(); 
                $table->string('t_photo')->nullable(); 
                $table->string('t_category')->nullable();
                $table->string('t_added_by')->nullable();
                $table->string('t_added_at')->nullable();
                $table->string('t_last_edited_by')->nullable(); 
                $table->string('t_last_edited_at')->nullable(); 
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
        Schema::dropIfExists('tbl_team');
    }
}
