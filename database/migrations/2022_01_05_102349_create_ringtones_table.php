<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingtonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringtones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('thumbnail_image')->nullable();
            $table->boolean('feature');
            $table->boolean('set_as_premium')->default(0);
            $table->integer('downloads')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->longText('ringtone_file');
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
        Schema::dropIfExists('ringtones');
    }
}
