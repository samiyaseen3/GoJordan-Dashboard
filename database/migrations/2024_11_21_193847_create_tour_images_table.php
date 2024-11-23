<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourImagesTable extends Migration
{
    public function up()
    {
        Schema::create('tour_images', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('tour_id')->constrained()->onDelete('cascade'); 
            $table->string('file_name'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_images');
    }
}
