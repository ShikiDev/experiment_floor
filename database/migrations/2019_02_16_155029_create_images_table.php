<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediatekas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filepath');
            $table->string('media_tag');
            $table->string('media_type');
            $table->integer('post_uid');
            $table->string('main_img',10);
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
        Schema::dropIfExists('mediatekas');
    }
}
