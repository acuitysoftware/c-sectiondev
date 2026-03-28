<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->text('header_text')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->string('email')->nullable();
            $table->string('email_2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('order_link')->nullable();
            $table->string('google_link')->nullable();
            $table->string('android_app_link')->nullable();
            $table->string('ios_app_link')->nullable();
            $table->text('map')->nullable();
            $table->string('opening_hour')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
