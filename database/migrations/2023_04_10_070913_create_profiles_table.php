<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('image')->nullable(true);
            $table->date('birthday')->nullable(true);
            $table->longText('avatar')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('note')->nullable(true);
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};