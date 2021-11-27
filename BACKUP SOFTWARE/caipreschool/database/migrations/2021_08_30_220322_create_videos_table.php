<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->longText('video_title');
            $table->longText('video_desc');
            $table->string('category');
            $table->longText('video_thumbnail');
            $table->longText('video_file_name');
            $table->softDeletes();
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
        Schema::dropIfExists('videos');
        Schema::table('announcements', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
}
