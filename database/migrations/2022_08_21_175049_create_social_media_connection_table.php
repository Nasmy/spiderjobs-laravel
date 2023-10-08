<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_connection', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('social_media_type_id');
            $table->string('connection_logo');
            $table->string('client_id');
            $table->string('access_token');
            $table->tinyInteger('token_expire_in');
            $table->timestamps();

            $table->foreign('social_media_type_id')->references('id')->on('social_media_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_connection');
    }
}
