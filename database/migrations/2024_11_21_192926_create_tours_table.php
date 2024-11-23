<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description'); 
            $table->decimal('price', 10, 2); 
            $table->integer('duration'); 
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->string('image_url')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
