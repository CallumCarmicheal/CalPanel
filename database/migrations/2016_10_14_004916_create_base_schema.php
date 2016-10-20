<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseSchema extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('servers', function (Blueprint $table) {
            // Table information
            $table->increments('id');
            $table->integer('owner');
            $table->string('name');

            // PDO Information
            $table->string('db_host');
            $table->string('db_name');
            $table->string('db_user');
            $table->string('db_pass');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('servers');
    }
}
