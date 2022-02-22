<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_images', function (Blueprint $table) {
            $table->uuid('i_id')->primary();
            $table->uuid('i_user')->nullable();
            $table->string('i_image')->nullable();
            $table->string('i_location')->nullable();
            $table->string('i_date')->nullable();
            $table->string('i_device')->nullable();
            $table->string('i_os_type')->nullable();
            $table->string('i_date_added')->nullable();
            $table->string('i_status')->nullable();
            $table->uuid('album_id')->nullable();
            $table->string('caption')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_images');
    }
}
