<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1)->comment("1=>AI,2=>Admin");
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('subject_id')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->integer('difficulty')->nullable();
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->longText('name')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->date('reply_date')->nullable();
            $table->time('reply_time')->nullable();
            $table->boolean('is_bookmarks')->default(false);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('chats');
    }
}
