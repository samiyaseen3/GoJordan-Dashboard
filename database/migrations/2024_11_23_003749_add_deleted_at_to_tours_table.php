<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToToursTable extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->softDeletes(); // This adds the 'deleted_at' column
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropSoftDeletes(); // This drops the 'deleted_at' column
        });
    }
}
