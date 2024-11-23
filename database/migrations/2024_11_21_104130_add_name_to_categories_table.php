<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Adding the 'name' column to the categories table
            $table->string('name')->after('id'); // You can adjust the position of the column (here it's placed after 'id')
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Dropping the 'name' column if rolling back
            $table->dropColumn('name');
        });
    }
}