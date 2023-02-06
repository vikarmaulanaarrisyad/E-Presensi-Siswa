<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->enum('gander', ['L', 'P']);
            $table->string('place_birth');
            $table->date('date_birth');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_work');
            $table->string('mother_work');
            $table->integer('child_number')->default(0);
            $table->bigInteger('income');
            $table->enum('status', ['aktif', 'tidak aktif', 'pindah sekolah', 'keluar',]);
            $table->unsignedBigInteger('academic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
