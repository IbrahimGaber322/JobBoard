<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobportals', function (Blueprint $table) {
            $table->string('experience_level')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('skills')->nullable();
            $table->string('salary_range')->nullable();
            $table->date('date')->nullable();
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('work_type')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('emp_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->integer('no_of_candidates')->nullable();
            $table->date('deadline')->nullable();

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobportals', function (Blueprint $table) {
            //
            $table->dropColumn('experience_level');
            $table->dropColumn('responsibilities');
            $table->dropColumn('skills');
            $table->dropColumn('salary_range');
            $table->dropColumn('date');
            $table->dropColumn('category');
            $table->dropColumn('location');
            $table->dropColumn('work_type');
            $table->dropColumn('status');
            $table->dropForeign(['emp_id']);
            $table->dropColumn('emp_id');
            $table->dropColumn('no_of_candidates');
            $table->dropColumn('deadline');
        });
    }
};
