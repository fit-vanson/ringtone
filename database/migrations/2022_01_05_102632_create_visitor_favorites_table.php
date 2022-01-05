<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ringtone_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('visitor_id')->unsigned()->nullable()->default(null);
            $table->foreign('visitor_id')->references('id')
                ->on('visitors')->onDelete('cascade');
            $table->foreign('ringtone_id')->references('id')
                ->on('ringtones')->onDelete('cascade');
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
        Schema::dropIfExists('visitor_favorites');
    }
}
