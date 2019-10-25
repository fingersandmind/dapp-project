<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dapps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->string('dapp_name');
            $table->string('slug');
            $table->string('email');
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('dapp_logo')->nullable();
            $table->string('dapp_icon')->nullable();
            $table->enum('status',array('Pending','Enabled','Disabled'))->default('Pending');

            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('telegram')->nullable();
            $table->string('discord')->nullable();
            $table->string('reddit')->nullable();
            $table->string('bitcointalk')->nullable();
            $table->string('wechat')->nullable();

            $table->text('notes')->nullable();
            
            $table->SoftDeletes();
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
        Schema::dropIfExists('dapps');
    }
}
