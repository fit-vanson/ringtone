<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->longText('header_image');
            $table->string('site_name');
            $table->string('web_site');
            $table->boolean('ad_switch')->default(0);
            $table->boolean('load_view_by')->default(1);
            $table->string('header_title')->nullable();
            $table->longText('header_content')->nullable();
            $table->string('body_title')->nullable();
            $table->longText('body_content')->nullable();
            $table->string('footer_title')->nullable();
            $table->longText('footer_content')->nullable();
            $table->longText('policy')->nullable();
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
        Schema::dropIfExists('sites');
    }
}
