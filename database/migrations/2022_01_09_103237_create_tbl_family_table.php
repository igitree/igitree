<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_family', function (Blueprint $table) {
            $table->uuid('f_id')->primary();
            $table->uuid('f_fathers')->nullable();
            $table->uuid('f_mothers')->nullable();
            $table->uuid('f_husbands')->nullable();
            $table->uuid('f_wives')->nullable();
            $table->string('f_fullname')->nullable();
            $table->string('f_gender')->nullable();
            $table->uuid('f_indentity')->nullable();
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
        Schema::dropIfExists('tbl_family');
    }
}
