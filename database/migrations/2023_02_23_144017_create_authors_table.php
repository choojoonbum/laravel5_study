<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function($table) {
            $table->increments('id'); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('email', 255); // title VARCHAR(100)
            $table->string('password', 60); // body TEXT
            $table->timestamps(); // created_at TIMESTAMP, updated_at TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors'); // DROP TABLE posts
    }
}
