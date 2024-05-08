<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortalJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portal_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('desc');
            $table->string('title');
            $table->string('experience_level');
            $table->text('responsibilities');
            $table->text('skills');
            $table->string('salary_range');
            $table->dateTime('date');
            $table->string('category');
            $table->string('location');
            $table->enum('work_type', ['remote', 'onsite', 'hybrid'])->default('remote');
            $table->string('status');
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('no_of_candidates')->unsigned();
            $table->dateTime('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_jobs');
    }
}
