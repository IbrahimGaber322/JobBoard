<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->string('resume')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->text('skills')->nullable();
            $table->text('experience')->nullable();
            $table->integer('no_of_employees')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'gender', 'image', 'bio', 'resume', 'title', 'location', 'skills', 'experience', 'no_of_employees']);
        });
    }
};
